<?php

namespace App\Filament\Resources\VisitorResource\Widgets;

use App\Services\VisitorService;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class VisitorWidgetChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kunjungan Per-bulan';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = app(VisitorService::class)->getDataGroupedByMonth(Carbon::now()->year);

        return [
            'datasets' => [
                [
                    'label' => 'Visitor Count',
                    'data' => array_values($data),
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public static function canView(): bool
    {
        return auth()->user()->isAdmin();
    }
}
