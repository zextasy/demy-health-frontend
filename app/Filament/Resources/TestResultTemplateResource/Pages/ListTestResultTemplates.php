<?php

namespace App\Filament\Resources\TestResultTemplateResource\Pages;

use App\Filament\Resources\TestResultTemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestResultTemplates extends ListRecords
{
    protected static string $resource = TestResultTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
