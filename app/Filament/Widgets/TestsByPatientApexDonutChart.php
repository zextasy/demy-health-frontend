<?php
namespace App\Filament\Widgets;

use App\Models\Patient;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TestsByPatientApexDonutChart extends ApexChartWidget
{
    /**
     * Polling Interval
     *
     * @var string|null
     */
    protected static ?string $pollingInterval = '600';

    protected int | string | array $columnSpan = 6;

    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'pie-tests-by-patient-donut-chart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Tests By Patient';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $trend = Patient::query()->has('testBookings')->withCount('testBookings')
                ->orderBy('test_bookings_count', 'desc')->limit(15)
            ->get(['first_name','middle_name','last_name','test_bookings_count']);
        $data = $trend->map(fn (Patient $dataPoint) => $dataPoint->test_bookings_count);
        $labels = $trend->map(fn (Patient $dataPoint) => $dataPoint->full_name);
        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $data,
            'labels' => $labels,
            'dataLabels'=> [
                'enabled' => false
            ],
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
    }
}
