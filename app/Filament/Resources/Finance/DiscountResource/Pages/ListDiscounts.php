<?php

namespace App\Filament\Resources\Finance\DiscountResource\Pages;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Finance\DiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiscounts extends ListRecords
{
    protected static string $resource = DiscountResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->with(['discount','orders']);
    }

    protected function getHeaderActions(): array
    {
        //TODO fix n+1 query - order
        return [
            Actions\CreateAction::make(),
        ];
    }
}
