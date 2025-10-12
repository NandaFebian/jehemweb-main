<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Enums\Role;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitorOverview extends BaseWidget
{

    protected int | string | array $columnSpan = 2;
    protected function getStats(): array
    {

        $products = Product::query()->where('user_id', auth()->user())->get();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->visitor_count;
        }
        return [
            Stat::make('Pengunjung Produk', $total),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole(Role::USER->value);
    }
}
