<?php

namespace App\Services;

use App\Models\Visitor;
use Illuminate\Support\Carbon;

class VisitorService
{
    private const MONTHS = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    /**
     * Count one visit for the given day (today by default).
     */
    public function recordVisit(?Carbon $date = null): void
    {
        $date ??= Carbon::now();

        Visitor::query()
            ->firstOrCreate(
                ['date' => $date->day, 'month' => $date->month, 'year' => $date->year],
                ['count' => 0],
            )
            ->increment('count');
    }

    /**
     * Total visits per month of the given year, keyed by (Indonesian) month name.
     *
     * @return array<string, int>
     */
    public function getDataGroupedByMonth(int $year): array
    {
        $totals = Visitor::query()
            ->where('year', $year)
            ->groupBy('month')
            ->selectRaw('month, SUM(count) as total_visits')
            ->pluck('total_visits', 'month');

        $visitsPerMonth = [];
        foreach (self::MONTHS as $number => $name) {
            $visitsPerMonth[$name] = (int) ($totals[$number] ?? 0);
        }

        return $visitsPerMonth;
    }
}
