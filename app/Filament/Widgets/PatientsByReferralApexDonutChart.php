<?php
namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use Flowframe\Trend\TrendValue;
use App\Models\ReferralChannel;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class PatientsByReferralApexDonutChart extends ApexChartWidget
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
    protected static string $chartId = 'pie-patients-by-referral-donut-chart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Patients By Referral';

    public static function canView(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function getOptions(): array
    {
        $trend = ReferralChannel::query()->has('patients')->withCount('patients')
            ->orderBy('patients_count', 'desc')->limit(15)
            ->get(['name','patients_count']);
        $data = $trend->map(fn (ReferralChannel $dataPoint) => $dataPoint->patients_count);
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
