<?php

namespace App\Filament\Resources;

use App\Enums\AttachmentType;
use App\Enums\ContactPlatform;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
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

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

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
                        Textarea::make('important_information')
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
                        // Admins may create a product on behalf of a shop owner; owners always own their products.
                        Select::make('user_id')
                            ->label('Pemilik')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->default(fn () => auth()->id())
                            ->required()
                            ->visible(fn () => self::isAdmin()),
                    ]),
                Section::make()
                    ->schema([
                        Repeater::make('contacts')
                            ->label('Kontak')
                            ->schema([
                                Select::make('platform')
                                    ->label('Platform')
                                    ->options(ContactPlatform::option())
                                    ->required(),
                                TextInput::make('url')
                                    ->label('URL / Nomor')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->minItems(1)
                            ->columnSpanFull(),
                    ]),
                Section::make()
                    ->schema([
                        Repeater::make('attachments')
                            ->label('Foto / Video')
                            ->relationship()
                            ->schema([
                                Select::make('type')
                                    ->label('Tipe File')
                                    ->options(AttachmentType::option())
                                    ->default(AttachmentType::IMAGE->value)
                                    ->required(),
                                TextInput::make('name')
                                    ->label('Nama file')
                                    ->required()
                                    ->maxLength(255),
                                FileUpload::make('path')
                                    ->label('File')
                                    ->disk('public')
                                    ->directory('products')
                                    ->acceptedFileTypes(['image/*', 'video/*'])
                                    ->maxSize(20 * 1024)
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
            ->modifyQueryUsing(fn (Builder $query) => self::isAdmin() ? $query : $query->whereBelongsTo(auth()->user()))
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemilik')
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('approve')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Product $record) => $record->update(['is_approved' => true]))
                    ->hidden(fn (Product $record) => $record->is_approved || ! self::isAdmin()),
                Action::make('activate')
                    ->color('success')
                    ->action(fn (Product $record) => $record->update(['is_active' => true]))
                    ->hidden(fn (Product $record) => $record->is_active || self::isAdmin()),
                Action::make('inactivate')
                    ->color('danger')
                    ->action(fn (Product $record) => $record->update(['is_active' => false]))
                    ->hidden(fn (Product $record) => ! $record->is_active || self::isAdmin()),
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
        return (bool) auth()->user()?->isAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        return self::isAdmin() || $record->user_id === auth()->id();
    }

    public static function canDelete(Model $record): bool
    {
        return self::canEdit($record);
    }

    /**
     * Admins can always create products; a shop owner needs an activated account and may own one product.
     */
    public static function canCreate(): bool
    {
        $user = auth()->user();

        if (self::isAdmin()) {
            return true;
        }

        return $user->is_active && ! $user->products()->exists();
    }
}
