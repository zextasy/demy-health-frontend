<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\TestResult;
use App\Models\TestBooking;
use Filament\Facades\Filament;
use App\Models\TestResultTemplate;
use Filament\Forms\Components\Hidden;
use App\Services\VirtualFieldService;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\TestResultResource;
use Filament\Forms\Concerns\InteractsWithForms;

class EnterTestResultDetails extends Page implements HasForms
{
    use InteractsWithForms;

    public $data;
    private ?TestBooking $testBooking = null;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.enter-test-result-details';

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount(): void
    {
        $this->testBooking = TestBooking::findOrFail(request()->get('testBookingId'));
        $this->form->fill([
            'test_booking_id' => $this->testBooking->id,
            'customer_email' => $this->testBooking->customer_email,
            'customer_phone_number' => $this->testBooking->customer_phone_number,
        ]);
    }


    protected function getFormSchema(): array
    {

        $testResultTemplate = $this->testBooking?->testType->testResultTemplate;

        $basicFields = [
            Hidden::make('test_booking_id'),
            Section::make('General Info')
                ->columns(2)
                ->schema([
                TextInput::make('customer_email'),
                TextInput::make('customer_phone_number'),
            ]),

        ];

        $extraFields = [
            Section::make('Result Info')
                ->columns(2)
                ->schema((new VirtualFieldService)->getFilamentFormFields($testResultTemplate)),
        ];
        return array_merge($basicFields, $extraFields);
    }

    public function getCancelButtonUrlProperty()
    {
        return Filament::getUrl();
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }

    public function submit(): void
    {
        $testResult = new TestResult;
        $testResult->has_template_data = true;
        foreach ($this->data as $key => $value) {
            $testResult->$key = $value;
        }
        $testResult->save();
        $this->notify('success', 'The Details have been Saved.');
        $this->redirect(TestResultResource::getUrl('view', ['record' => $testResult->id]));
    }
}
