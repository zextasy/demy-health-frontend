<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\BarChartWidget;

class TotalTestsChart extends BarChartWidget
{
    protected static ?string $heading = 'Tests';

    protected int | string | array $columnSpan = 8;

    public ?string $filter = 'month';

    public static function canView(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        $trend = Trend::query(TestBooking::query())
            ->dateColumn('due_date')
            ->between(start: now()->startOfMonth(), end: now()->endOfMonth())
            ->perDay()->count();
        $data = $trend->map(fn (TrendValue $dataPoint) => $dataPoint->aggregate);
        $labels = $trend->map(fn (TrendValue $dataPoint) => Carbon::create($dataPoint->date)->toFormattedDateString());
        $colors = $this->backgroundColors;

        return [
            'datasets' => [
                [
                    'label' => 'Tests',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
            'backgroundColor' => $colors,
            'borderColor' => $colors,
            'borderWidth' => 1
        ];
    }

    protected function getFilters(): ?array
    {
        return [
//            'today' => 'Today',
//            'week' => 'Last week',
//            'month' => 'This month',
//            'year' => 'This year',
        ];
    }
}
