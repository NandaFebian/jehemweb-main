<?php

namespace App\Filament\Resources;

use App\Enums\AttachmentType;
use App\Enums\ContactPlatform;
use App\Enums\Role;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label('Aktivasi')
                            ->default(true)
                            ->required(),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull()
                            ->maxLength(255),
                        TextArea::make('important_information')
                            ->label('Informasi Penting')
                            ->columnSpanFull()
                            ->maxLength(255),

                        Select::make('categories')
                            ->label('Kategori')
                            ->relationship('categories', 'name')
                            ->preload()
                            ->optionsLimit(10)
                            ->multiple()
                            ->columnSpanFull(),
                        Select::make('selected_user_id')
                            ->hidden(auth()->user()->hasRole(Role::USER))
                            ->relationship('user', 'name'),
                    ]),
                Section::make()
                    ->schema([
                        Forms\Components\Repeater::make('contacts')
                            ->schema([
                                Select::make('platform')
                                    ->label('Platform')
                                    ->options(ContactPlatform::option())
                                    ->required(),
                                TextInput::make('url')
                                    ->label('URL')
                                    ->required()
                                    ->required(),
                            ])
                            ->minItems(1)
                            ->columnSpanFull(),
                    ]),
                Section::make()
                    ->schema([
                        Repeater::make('attachments')
                            ->relationship()
                            ->schema([
                                Select::make('type')
                                    ->label('Tipe File')
                                    ->options(AttachmentType::option())
                                    ->required(),
                                TextInput::make('name')
                                    ->label('Nama file')
                                    ->required(),
                                FileUpload::make('path')
                                    ->label('File')
                                    ->previewable()
                                    ->required(),
                            ])
                            ->columnSpanFull()
                            ->minItems(1),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (!self::isAdmin()) {
                    return $query->where('user_id', auth()->user()->id);
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->boolean(),
                Tables\Columns\TextColumn::make('visitor_count')
                    ->numeric()
                    ->sortable(),
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
                Action::make('approve')
                    ->color('success')
                    ->action(function (Model $record) {
                        $record->is_approved = true;
                        $record->save();
                    })
                    ->hidden(fn (Model $record) => $record->is_approved || !self::isAdmin()),
                Action::make('activate')
                    ->color('success')
                    ->action(function (Model $record) {
                        $record->is_active = true;
                        $record->save();
                    })
                    ->hidden(fn (Model $record) => $record->is_active || self::isAdmin()),
                Action::make('inactivate')
                    ->color('danger')
                    ->action(function (Model $record) {
                        $record->is_active = false;
                        $record->save();
                    })
                    ->hidden(fn (Model $record) => !$record->is_active || self::isAdmin()),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function isAdmin(): bool
    {
        $user = User::findOrFail(auth()->user()->id);

        return $user->hasRole(Role::ADMIN->value) || $user->hasRole(Role::SUPER_ADMIN->value);
    }

    public static function canEdit(Model $record): bool
    {
        if (self::isAdmin()) {
            return true;
        }

        return $record->user_id == auth()->user()->id;
    }

    public static function canCreate(): bool
    {
        if (!auth()->user()->is_active) {
            return false;
        }

        if (!auth()->user()->hasRole(Role::USER)) {
            return true;
        }

        return Product::query()->where('user_id', auth()->user()->id)->count() < 1;
    }
}
