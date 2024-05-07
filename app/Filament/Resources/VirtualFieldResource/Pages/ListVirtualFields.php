<?php

namespace App\Filament\Resources\VirtualFieldResource\Pages;

use App\Filament\Resources\VirtualFieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVirtualFields extends ListRecords
{
    protected static string $resource = VirtualFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
