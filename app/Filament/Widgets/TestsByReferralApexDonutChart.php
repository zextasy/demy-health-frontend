<?php
namespace App\Filament\Widgets;

use App\Models\ReferralChannel;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TestsByReferralApexDonutChart extends ApexChartWidget
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
    protected static string $chartId = 'pie-tests-by-referral-donut-chart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Tests By Referral';

    public static function canView(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function getOptions(): array
    {
        $trend = ReferralChannel::query()->has('testBookings')->withCount('testBookings')
            ->orderBy('test_bookings_count', 'desc')->limit(15)
            ->get(['name','test_bookings_count']);
        $data = $trend->map(fn (ReferralChannel $dataPoint) => $dataPoint->test_bookings_count);
        $labels = $trend->map(fn (ReferralChannel $dataPoint) => $dataPoint->name);
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
