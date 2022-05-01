<?php

namespace App\Filament\Resources\TestBookingResource\Pages;

use App\Filament\Resources\TestBookingResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TestBookingResource\Widgets\TestBookingCalendarWidget;

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
