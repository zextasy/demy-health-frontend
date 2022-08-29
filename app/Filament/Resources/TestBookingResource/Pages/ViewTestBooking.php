<?php

namespace App\Filament\Resources\TestBookingResource\Pages;

use App\Filament\Actions\BaseAction;
use Filament\Pages\Actions\ViewAction;
use Filament\Pages\Actions\ActionGroup;
use App\Filament\Resources\TestBookingResource;
use Filament\Resources\Pages\ViewRecord;

class ViewTestBooking extends ViewRecord
{
    protected static string $resource = TestBookingResource::class;

    protected function getActions(): array
    {
        return [
            BaseAction::make('assign task')->grouped(),
            BaseAction::make('confirm start')->grouped(),
            BaseAction::make('mark as complete'),
        ];
    }
}
