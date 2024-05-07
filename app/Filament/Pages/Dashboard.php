<?php

namespace App\Filament\Pages;

use Filament\Widgets\AccountWidget;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;
use App\Filament\Widgets\TotalTestsApexBarChart;
use App\Filament\Widgets\TestsByPatientApexDonutChart;
use App\Filament\Widgets\TestsByReferralApexDonutChart;
use App\Filament\Widgets\PatientsByReferralApexDonutChart;

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
