<?php

namespace App\Filament\Admin\Resources\Communication\CommunicationResource\Pages;

use App\Filament\Admin\Resources\Communication\CommunicationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommunications extends ListRecords
{
    protected static string $resource = CommunicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}