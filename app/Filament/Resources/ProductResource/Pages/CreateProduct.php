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
        if (!isset($data['selected_user_id']) || is_null($data['selected_user_id'])) {
            $data['user_id'] = auth()->user()->id;
        } else {
            $data['user_id'] = $data['selected_user_id'];
        }

        return $data;
    }
}
