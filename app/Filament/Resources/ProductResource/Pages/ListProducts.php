<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        $user = User::findOrFail(auth()->user()->id);

        return [
            Actions\CreateAction::make()->hidden(! $user->is_active),
        ];
    }
}
