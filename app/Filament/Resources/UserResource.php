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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->required(fn (string $operation) => $operation == 'create')
                    ->hidden(!auth()->user()->hasRole(Role::SUPER_ADMIN))
                    ->maxLength(255),

                Select::make('role')
                    ->options([
                        Role::ADMIN->value => 'Admin',
                        Role::USER->value => 'User',
                    ])
                    ->required()
                    ->hidden(!auth()->user()->hasRole(Role::SUPER_ADMIN))
                    ->formatStateUsing(fn ($record) => is_null($record) ? null : $record->roles->first()->name),
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->hidden(auth()->user()->hasRole(Role::USER)),
                Forms\Components\FileUpload::make('profile_image_path')
                    ->image(),
            ]);
    }

    public static function canEdit(Model $record): bool
    {
        if (auth()->user()->hasRole(Role::USER) || auth()->user()->hasRole(Role::ADMIN)) {
            return static::canViewAny() && auth()->user()->id === $record->id;
        }

        return static::canViewAny();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->hasRole(Role::USER)) {
                    return $query->where('id', auth()->user()->id);
                }

                return $query;
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('role')
                    ->getStateUsing(fn ($record) => $record->roles->first()->name ?? null)
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('activate')
                    ->color('success')
                    ->action(function (Model $record) {
                        $record->is_active = true;
                        $record->save();
                    })
                    ->hidden(fn (Model $record) => $record->is_active || auth()->user()->hasRole(Role::USER)),
                Action::make('inactivate')
                    ->color('danger')
                    ->action(function (Model $record) {
                        $record->is_active = false;
                        $record->save();
                    })
                    ->hidden(fn (Model $record) => !$record->is_active || auth()->user()->hasRole(Role::USER)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->hasRole(Role::SUPER_ADMIN);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
