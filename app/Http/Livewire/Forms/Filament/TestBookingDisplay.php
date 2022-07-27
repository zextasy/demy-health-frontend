<?php

namespace App\Http\Livewire\Forms\Filament;

use App\Models\TestBooking;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class TestBookingDisplay extends Component implements HasForms
{
    use InteractsWithForms;

    public TestBooking $testBooking;

    public function mount(): void
    {
        $this->form->fill([
            'reference' => $this->testBooking->reference,
            'patient_first_name' => $this->testBooking->patient?->first_name,
            'patient_last_name' => $this->testBooking->patient?->last_name,
            'location_type' => $this->testBooking->location_type->name,
            'testType' => $this->testBooking->testType->name,
            'due_date' => $this->testBooking->due_date->toDateTimeString(),
            'duration_minutes' => $this->testBooking->duration_minutes,
            'testCenter' => $this->testBooking->testCenter?->name,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('General Info')->schema([
                TextInput::make('reference')
                    ->disabled(),
                TextInput::make('testType')
                    ->disabled(),
                TextInput::make('status')
                    ->placeholder('')
                    ->disabled(),
            ])->columns(3),
            Fieldset::make('Customer Details')->schema([
                TextInput::make('patient_first_name')
                    ->label('Patient First Name')
                    ->disabled(),
                TextInput::make('patient_last_name')
                    ->label('Patient Last Name')
                    ->disabled(),
            ])->columns(2),
            Fieldset::make('Schedule')->schema([
                TextInput::make('due_date')
                    ->label('Scheduled For')
                    ->disabled(),
                TextInput::make('duration_minutes')
                    ->disabled(),
            ])->columns(3),
            Fieldset::make('Location')->schema([
                TextInput::make('location_type')
                    ->disabled(),
                TextInput::make('testCenter')
                    ->placeholder('')
                    ->disabled(),
            ]),
        ];
    }

    public function render()
    {
        return view('livewire.forms.filament.test-booking-display');
    }
}
