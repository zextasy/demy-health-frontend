<?php

namespace App\Filament\Resources\TestResultTemplateResource\Pages;

use App\Filament\Resources\TestResultTemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTestResultTemplate extends ViewRecord
{
    protected static string $resource = TestResultTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
