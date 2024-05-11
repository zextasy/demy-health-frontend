<?php

namespace App\Filament\Admin\Pages;

use Filament\Widgets\AccountWidget;
use App\Filament\Admin\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;
use App\Filament\Admin\Widgets\TotalTestsApexBarChart;
use App\Filament\Admin\Widgets\TestsByPatientApexDonutChart;
use App\Filament\Admin\Widgets\TestsByReferralApexDonutChart;
use App\Filament\Admin\Widgets\PatientsByReferralApexDonutChart;

class Dashboard extends BasePage
{
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            StatsOverview::class,
            TotalTestsApexBarChart::class,
            TestsByPatientApexDonutChart::class,
            TestsByReferralApexDonutChart::class,
            PatientsByReferralApexDonutChart::class,
        ];
    }
}
