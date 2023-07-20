<?php

namespace App\Filament\Resources\Communication\CommunicationResource\Pages;

use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\Communication\CommunicationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommunication extends EditRecord
{
    protected static string $resource = CommunicationResource::class;

    protected function getFormSchema(): array
    {
        return [
            RichEditor::make('content'),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }
}
