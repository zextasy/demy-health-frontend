<?php

namespace App\Filament\Resources\TestBookingResource\Pages;

use App\Filament\Resources\TestBookingResource;
use App\Filament\Resources\TestBookingResource\Widgets\TestBookingCalendarWidget;
use Filament\Resources\Pages\ListRecords;

class ListTestBookings extends ListRecords
{
    protected static string $resource = TestBookingResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            TestBookingCalendarWidget::class,
        ];
    }
}
