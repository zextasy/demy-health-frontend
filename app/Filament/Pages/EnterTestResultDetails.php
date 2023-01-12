<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\TestBooking;
use App\Models\TestResultTemplate;
use Filament\Forms\Components\Hidden;
use App\Services\VirtualFieldService;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class EnterTestResultDetails extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.enter-test-result-details';

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getFormSchema(): array
    {
        $testBooking = TestBooking::findOrFail(request()->get('testBookingId'));
        $testResultTemplate = $testBooking->testType->testResultTemplate;

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

    public function submit()
    {
        $this->form->getState();
    }
}
