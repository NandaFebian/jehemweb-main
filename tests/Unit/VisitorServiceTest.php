<?php

namespace Tests\Unit;

use App\Models\Visitor;
use App\Services\VisitorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class VisitorServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_visits_are_grouped_per_month(): void
    {
        $service = new VisitorService();

        $service->recordVisit(Carbon::create(2026, 1, 5));
        $service->recordVisit(Carbon::create(2026, 1, 5));
        $service->recordVisit(Carbon::create(2026, 1, 20));
        $service->recordVisit(Carbon::create(2026, 3, 1));
        $service->recordVisit(Carbon::create(2025, 3, 1));

        $this->assertSame(1, Visitor::where(['date' => 20, 'month' => 1, 'year' => 2026])->sole()->count);

        $data = $service->getDataGroupedByMonth(2026);
        $this->assertCount(12, $data);
        $this->assertSame(3, $data['Januari']);
        $this->assertSame(0, $data['Februari']);
        $this->assertSame(1, $data['Maret']);
    }
}
