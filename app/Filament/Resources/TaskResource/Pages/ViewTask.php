<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTask extends ViewRecord
{
    protected static string $resource = TaskResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
