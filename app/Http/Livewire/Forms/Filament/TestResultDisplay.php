<?php

namespace App\Http\Livewire\Forms\Filament;

use Livewire\Component;
use App\Models\TestResult;
use App\Models\TestBooking;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class TestResultDisplay extends Component implements HasForms
{
    use InteractsWithForms;

    public TestResult $testResult;

    public function mount(): void
    {
        $this->form->fill([
            'reference' => $this->testResult->reference,
            'customer_email' => $this->testResult->customer_email,
            'customer_phone_number' => $this->testResult->customer_phone_number,
            'result_image' => $this->testResult->testType->name,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('General Info')->schema([
                TextInput::make('reference')
                    ->disabled(),
                TextInput::make('customer_email')
                    ->placeholder('')
                    ->disabled(),
                TextInput::make('customer_phone_number')
                    ->placeholder('')
                    ->disabled(),
            ])->columns(3),
            Fieldset::make('Result')->schema([

            ])->columns(1),
        ];
    }

    public function render()
    {
        return view('livewire.forms.filament.test-result-display');
    }
}
