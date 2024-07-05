<?php

namespace App\Filament\Admin\Pages\Dashboards;

use App\Constants\NavigationGroupConstants;
use Filament\Pages\Page;
use App\Filament\Admin\Widgets\TotalTestsApexBarChart;
use App\Filament\Admin\Widgets\TestsByPatientApexDonutChart;
use App\Filament\Admin\Widgets\TestsByReferralApexDonutChart;
use App\Filament\Admin\Widgets\PatientsByReferralApexDonutChart;

class TestsDashboard extends Page
{
    protected static ?string $navigationGroup = NavigationGroupConstants::DASHBOARDS;

    protected static string $view = 'filament.pages.dashboard';

    public static function shouldRegisterNavigation(): bool
    {
        return app()->islocal();
    }

    public function getWidgets(): array
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
