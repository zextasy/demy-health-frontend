<?php

namespace App\Filament\Resources\Finance\DiscountResource\Pages;

use App\Filament\Resources\Finance\DiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiscounts extends ListRecords
{
    protected static string $resource = DiscountResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
