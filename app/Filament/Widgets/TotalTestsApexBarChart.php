<?php
namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TotalTestsApexBarChart extends ApexChartWidget
{

    protected static ?string $pollingInterval = '600';

    protected int | string | array $columnSpan = 8;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'bar-total-tests-apex-bar-chart';

    protected static ?string $heading = 'Tests';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $trend = Trend::query(TestBooking::query())
            ->dateColumn('due_date')
            ->between(start: now()->startOfMonth(), end: now()->endOfMonth())
            ->perDay()->count();
        $data = $trend->map(fn (TrendValue $dataPoint) => $dataPoint->aggregate);
        $labels = $trend->map(fn (TrendValue $dataPoint) => Carbon::create($dataPoint->date)->toFormattedDateString());
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'BasicBarChart',
                    'data' => $data,
                ],
            ],
            'xaxis' => [
                'categories' => $labels,
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#6366f1'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                ],
            ],
        ];
    }
}
