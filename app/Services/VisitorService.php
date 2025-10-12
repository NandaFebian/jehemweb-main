<?php

namespace App\Services;

use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class VisitorService
{
    private $months = [
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

    public function updateCountVisitor(int $date, int $month, int $year)
    {
        $visitor = Visitor::query()
            ->where('date', $date)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if (! $visitor) {
            $visitor = Visitor::create([
                'date' => $date,
                'month' => $month,
                'year' => $year,
                'count' => 1,
            ]);
        }

        $visitor->update(['count' => $visitor->count + 1]);
    }

    public function getDataGroupedByMonth(int $year)
    {

        // Inisialisasi array untuk hasil kunjungan per bulan
        $visitsPerMonth = array_fill_keys(array_values($this->months), 0);

        // Query untuk mendapatkan jumlah kunjungan per bulan
        $results = Visitor::select(DB::raw('SUM(count) as total_visits, month'))
            ->where('year', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($results as $result) {
            $visitsPerMonth[$this->months[$result->month]] = $result->total_visits;
        }

        return $visitsPerMonth;
    }
}
