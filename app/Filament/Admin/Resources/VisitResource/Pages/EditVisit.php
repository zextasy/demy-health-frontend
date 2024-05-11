<?php

namespace App\Filament\Admin\Resources\VisitResource\Pages;

use Filament\Pages\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\VisitResource;

class EditVisit extends EditRecord
{
    protected static string $resource = VisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
//            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('reference')
                ->unique('visits', 'reference', fn ($record) => $record)
                ->maxLength(255),
        ];
    }
}
