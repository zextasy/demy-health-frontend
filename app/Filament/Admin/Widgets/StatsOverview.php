<?php

namespace App\Filament\Admin\Widgets;

use App\Models\CRM\CustomerEnquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\TestBooking;
use App\Models\TestType;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected int | string | array $columnSpan = 'full';

    protected function getCards(): array
    {
        return [
            //            Card::make('Available Test Types', TestType::all()->count()),
            Card::make('Available Test Types', TestType::count()),
            Card::make('Available Products', Product::count()),
            //            Card::make('Total Bookings', TestBooking::all()->count()),
            Card::make('Bookings Today', TestBooking::whereDate('created_at', today())->count()),
            //            Card::make('Total Orders', Order::all()->count()),
            Card::make('Orders Today', Order::whereDate('created_at', today())->count()),
            Card::make('Customer Enquiries Today', CustomerEnquiry::whereDate('created_at', today())->count()),
        ];
    }
}
