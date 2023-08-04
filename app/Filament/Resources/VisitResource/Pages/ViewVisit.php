<?php

namespace App\Filament\Resources\VisitResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\VisitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\PatientResource;

class ViewVisit extends ViewRecord
{
    protected static string $resource = VisitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('reference')
                ->unique('visits', 'reference', fn ($record) => $record)
                ->maxLength(255),
            Select::make('patient_id')->label('Patient')
                ->options(PatientResource::getModel()::all()->toSelectArray('full_name'))->required(),
        ];
    }
}
