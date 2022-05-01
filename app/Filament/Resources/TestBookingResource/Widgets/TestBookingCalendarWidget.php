<?php

namespace App\Filament\Resources\TestBookingResource\Widgets;

use App\Models\TestBooking;
use App\Filament\Resources\TestBookingResource;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class TestBookingCalendarWidget extends FullCalendarWidget
{

    public function getViewData(): array
    {
        return TestBooking::with('testType')
            ->get(['test_type_id','id','customer_email','due_date','start_time'])
            ->map(function ($item, $key) {
                return $item->toFullCalenderEventArray();
            })->toArray();
    }
}
