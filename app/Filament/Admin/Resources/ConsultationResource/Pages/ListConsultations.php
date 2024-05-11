<?php

namespace App\Filament\Admin\Resources\ConsultationResource\Pages;

use App\Filament\Admin\Resources\ConsultationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsultations extends ListRecords
{
    protected static string $resource = ConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
