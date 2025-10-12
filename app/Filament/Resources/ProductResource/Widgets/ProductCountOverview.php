<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Enums\Role;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductCountOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 2;

    protected function getStats(): array
    {
        $count = 0;
        if (auth()->user()->hasRole(Role::USER->value)) {
            $count = Product::query()->where('user_id', auth()->user())->count();
        }

        if (auth()->user()->hasRole(Role::ADMIN->value) || auth()->user()->hasRole(Role::SUPER_ADMIN->value)) {
            $count = Product::query()->count();
        }

        return [
            Stat::make('Total Produk', $count),
        ];
    }
}
