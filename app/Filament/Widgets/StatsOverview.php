<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\TestType;
use App\Models\TestBooking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Available Test Types', TestType::all()->count()),
            Card::make('Total Bookings', TestBooking::all()->count()),
            Card::make('Bookings Today', TestBooking::whereDate('created_at', today())->count()),
            Card::make('Available Products', Product::all()->count()),
            Card::make('Total Orders', '0'),
            Card::make('Orders Today', '0'),
        ];
    }
}
