<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitorOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 2;

    protected function getStats(): array
    {
        $total = Product::query()->whereBelongsTo(auth()->user())->sum('visitor_count');

        return [
            Stat::make('Pengunjung Produk', $total),
        ];
    }

    public static function canView(): bool
    {
        return ! auth()->user()->isAdmin();
    }
}
