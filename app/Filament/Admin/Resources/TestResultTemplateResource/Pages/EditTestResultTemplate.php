<?php

namespace App\Filament\Admin\Resources\TestResultTemplateResource\Pages;

use App\Filament\Admin\Resources\TestResultTemplateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestResultTemplate extends EditRecord
{
    protected static string $resource = TestResultTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}