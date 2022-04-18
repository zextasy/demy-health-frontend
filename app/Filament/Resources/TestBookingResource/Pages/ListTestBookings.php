<?php

namespace App\Filament\Resources\TestBookingResource\Pages;

use App\Filament\Resources\TestBookingResource;
use Filament\Resources\Pages\ListRecords;

class ListTestBookings extends ListRecords
{
    protected static string $resource = TestBookingResource::class;
}
