<?php

namespace App\Filament\Resources\VisitorResource\Widgets;

use App\Enums\Role;
use App\Services\VisitorService;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class VisitorWidgetChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kunjungan Per-bulan';

    protected int|string|array $columnSpan = 'full';

    private VisitorService $visitorService;

    public function __construct()
    {
        $this->visitorService = new VisitorService();
    }

    protected function getData(): array
    {
        $date = Carbon::now();
        $data = $this->visitorService->getDataGroupedByMonth($date->year);

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
        return auth()->user()->hasRole(Role::ADMIN->value) || auth()->user()->hasRole(Role::SUPER_ADMIN->value);
    }
}
