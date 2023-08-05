<?php

namespace App\Filament\Resources\VisitResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\VisitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\PatientResource;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Actions\Pages\Visits\RecordVItalSignsAction;

class ViewVisit extends ViewRecord
{
    protected static string $resource = VisitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
	        RecordVItalSignsAction::make()->forVisit($this->record),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
	        Fieldset::make('Details')->schema([
		        TextInput::make('reference')
			        ->unique('visits', 'reference', fn ($record) => $record)
			        ->maxLength(255),
		        Select::make('patient_id')->label('Patient')
			        ->options(PatientResource::getModel()::all()->toSelectArray('full_name'))->required(),
	        ]),
	        Fieldset::make('Location')->relationship('visitableLocation')->schema([
		        TextInput::make('name'),
	        ]),
	        Section::make('Vitals')
		        ->description('Most recent vital signs recorded')
		        ->relationship('latestVitalSignsRecord')
		        ->schema([
			        Fieldset::make('Vital signs')->schema(
				        [
					        TextInput::make('height')->numeric(),
					        TextInput::make('weight')->numeric(),
					        TextInput::make('bmi')->numeric(),
					        TextInput::make('body_temperature')->numeric(),
					        TextInput::make('heart_rate')->numeric(),
					        TextInput::make('respiratory_rate')->numeric(),
					        TextInput::make('blood_pressure_systolic')->numeric(),
					        TextInput::make('blood_pressure_diastolic')->numeric(),
					        DateTimePicker::make('created_at')->label('Captured at')->disabled(),
				        ]
			        )->columns(3),
		        ])
        ];
    }
}
