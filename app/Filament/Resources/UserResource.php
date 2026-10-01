<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn (string $operation) => $operation === 'create')
                    ->dehydrated(fn (?string $state) => filled($state))
                    ->dehydrateStateUsing(fn (string $state) => Hash::make($state))
                    ->visible(fn () => self::currentUser()->isSuperAdmin())
                    ->maxLength(255),

                // Not a model attribute: synced to spatie roles by the Create/Edit pages.
                Select::make('role')
                    ->options([
                        Role::ADMIN->value => 'Admin',
                        Role::USER->value => 'User',
                    ])
                    ->required()
                    ->visible(fn () => self::currentUser()->isSuperAdmin())
                    ->formatStateUsing(fn (?User $record) => $record?->roles->first()?->name),

                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->visible(fn () => self::currentUser()->isAdmin()),

                Forms\Components\FileUpload::make('profile_image_path')
                    ->label('Foto profil')
                    ->disk('public')
                    ->directory('profiles')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => self::currentUser()->isAdmin()
                ? $query->with('roles')
                : $query->whereKey(auth()->id()))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('role')
                    ->getStateUsing(fn (User $record) => $record->roles->first()?->name)
                    ->default('-'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('activate')
                    ->color('success')
                    ->action(fn (User $record) => $record->update(['is_active' => true]))
                    ->hidden(fn (User $record) => $record->is_active || ! self::currentUser()->isAdmin()),
                Action::make('inactivate')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->update(['is_active' => false]))
                    ->hidden(fn (User $record) => ! $record->is_active || ! self::currentUser()->isAdmin() || $record->is(auth()->user())),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => self::currentUser()->isSuperAdmin()),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return self::currentUser()->isSuperAdmin();
    }

    /**
     * The super admin can edit anyone; everybody else can only edit their own profile.
     */
    public static function canEdit(Model $record): bool
    {
        return self::currentUser()->isSuperAdmin() || $record->is(auth()->user());
    }

    public static function canDelete(Model $record): bool
    {
        return self::currentUser()->isSuperAdmin() && ! $record->is(auth()->user());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    private static function currentUser(): User
    {
        return auth()->user();
    }
}
