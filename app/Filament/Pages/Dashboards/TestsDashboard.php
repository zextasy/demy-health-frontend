<?php

namespace App\Filament\Pages\Dashboards;

use Filament\Pages\Page;
use App\Filament\Widgets\TotalTestsApexBarChart;
use App\Filament\Widgets\TestsByPatientApexDonutChart;
use App\Filament\Widgets\TestsByReferralApexDonutChart;
use App\Filament\Widgets\PatientsByReferralApexDonutChart;

class TestsDashboard extends Page
{
    protected static ?string $navigationGroup = 'Dashboards';

    protected static string $view = 'filament.pages.dashboard';

    protected static function shouldRegisterNavigation(): bool
    {
        return app()->islocal();
    }

    protected function getWidgets(): array
    {
        return [
            TotalTestsApexBarChart::class,
            TestsByPatientApexDonutChart::class,
            TestsByReferralApexDonutChart::class,
            PatientsByReferralApexDonutChart::class,
        ];
    }

    protected function getColumns(): int | array
    {
        return 2;
    }
}
