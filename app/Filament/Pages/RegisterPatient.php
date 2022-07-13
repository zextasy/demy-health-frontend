<?php

namespace App\Filament\Pages;

use Closure;
use App\Models\Country;
use Filament\Pages\Page;
use App\Enums\GenderEnum;
use App\Models\TestBooking;
use App\Models\ReferralChannel;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Tabs;
use App\Enums\AgeClassificationEnum;
use App\Enums\PatientDataDetailEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Enums\PatientAcquisitionTypeEnum;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class RegisterPatient extends Page implements HasForms
{

    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.register-patient';

    protected static ?string $navigationGroup = 'CRM';

    public $acquisition;
    public $detail_level;
    public $reference;
    public $booking_reference;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $date_of_birth;
    public $age_in_years;
    public $age_classification;
    public $gender;
    public $height;
    public $weight;
    public $country_id;
    public $passport_number;
    public $email;
    public $phone_number;
    public $referral_code;
    public $referral_channel;

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Intro')
                    ->schema([
                        Fieldset::make('Entry')->schema([
                            Select::make('acquisition')
                                ->options(PatientAcquisitionTypeEnum::optionsAsSelectArray())
                                ->helperText('How did the patient come to the clinic?')
                                ->reactive()
                                ->required(),
                            Select::make('detail_level')
                                ->options(PatientDataDetailEnum::optionsAsSelectArray())
                                ->reactive()
                                ->helperText('How much data is required?')
                                ->required(),
                        ])->columns(2),
                        Fieldset::make('References')->schema([
                            TextInput::make('reference')
                                ->maxLength(255)
                                ->helperText('Reference number for the patient. Leave this blank and the system will generate one for you'),
                            Select::make('booking_reference')
                                ->options(TestBooking::doesntHave('testResult')->get()->toSelectArray())
                                ->searchable()
                                ->hidden(fn (Closure $get) => $get('acquisition') != PatientAcquisitionTypeEnum::TEST_BOOKING->value)
                                ->helperText('Reference number for the booking. This is required for patients with a booking.'),
                        ])->columns(2),
                    ]),
                Wizard\Step::make('Data')
                    ->schema([
                        Fieldset::make('Name')->schema([
                            TextInput::make('first_name')
                                ->required(),
                            TextInput::make('middle_name'),
                            TextInput::make('last_name')
                                ->required(),
                        ])->columns(3),
                        Fieldset::make('Age')->schema([
                            DatePicker::make('date_of_birth'),
                            TextInput::make('age_in_years')->numeric(),
                            Select::make('age_classification')->options(AgeClassificationEnum::optionsAsSelectArray()),
                        ])->columns(3),
                        Fieldset::make('Data')->schema([
                            Select::make('gender')->options(GenderEnum::optionsAsSelectArray()),
                            TextInput::make('height')->numeric(),
                            TextInput::make('weight')->numeric(),
                        ])->columns(3),
                        Fieldset::make('Nationality')->schema([
                            Select::make('country_id')
                                ->options(Country::all()->toSelectArray())
                                ->searchable()
                                ->label("Nationality"),
                            TextInput::make('passport_number')
                                ->maxLength(255),
                        ])->columns(2),
                        Fieldset::make('Contact')->schema([
                            TextInput::make('email')
                                ->email()
                                ->maxLength(255),
                            TextInput::make('phone_number')
                                ->tel()
                                ->maxLength(255),
                        ])->columns(2),
                    ]),
                Wizard\Step::make('Referral')->schema([
                    Fieldset::make('Referral')->schema([
                        TextInput::make('referral_code')
                            ->maxLength(255),
                        Select::make('referral_channel')
                            ->options(ReferralChannel::all()->toSelectArray())
                            ->searchable(),
                    ])->columns(2),
                ]),
            ])
                ->submitAction(view('filament.forms.components.wizard-submit-button'))
        ];
    }

    public function submitWizard(): void
    {
        $this->redirect('/admin');
    }
}
