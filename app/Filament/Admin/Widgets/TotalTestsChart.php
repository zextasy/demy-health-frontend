<?php

namespace App\Filament\Admin\Widgets;

use Flowframe\Trend\Trend;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class TotalTestsChart extends ChartWidget
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


        return [
            'datasets' => [
                [
                    'label' => 'Tests',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
//            'backgroundColor' => $colors,
//            'borderColor' => $colors,
            'borderWidth' => 1
        ];
    }
    protected function getType(): string
    {
        return 'bar';
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
