<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // The owner select is only shown to admins; everyone else creates products for themselves.
        if (! ProductResource::isAdmin() || empty($data['user_id'])) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }
}
