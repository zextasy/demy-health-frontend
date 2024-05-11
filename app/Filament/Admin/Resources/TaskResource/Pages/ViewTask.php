<?php

namespace App\Filament\Admin\Resources\TaskResource\Pages;

use App\Models\Task;
use App\Filament\Admin\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTask extends ViewRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->visible(fn (Task $record): bool => auth()->user()->can('update', $record)),
        ];
    }
}
