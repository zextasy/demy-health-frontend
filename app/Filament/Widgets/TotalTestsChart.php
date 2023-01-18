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

private array $backgroundColors = [
'rgba(255, 99, 132, 0.2)',
'rgba(255, 159, 64, 0.2)',
'rgba(255, 205, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(201, 203, 207, 0.2)'
];

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
