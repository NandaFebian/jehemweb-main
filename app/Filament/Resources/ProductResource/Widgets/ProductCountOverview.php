<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductCountOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 2;

    protected function getStats(): array
    {
        $user = auth()->user();

        $count = Product::query()
            ->when(! $user->isAdmin(), fn ($query) => $query->whereBelongsTo($user))
            ->count();

        return [
            Stat::make('Total Produk', $count),
        ];
    }
}
