<?php

namespace App\Filament\Admin\Pages;

use App\Actions\Patients\CreatePatientAction;
use App\Enums\AgeClassificationEnum;
use App\Enums\GenderEnum;
use App\Enums\PatientDataDetailEnum;
use App\Filament\Admin\Resources\PatientResource;
use App\Models\Country;
use App\Models\ReferralChannel;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;

class RegisterPatient extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static string $view = 'filament.pages.register-patient';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 1;

    public $acquisition;

    public $detailLevel;

    public $reference;

    public $bookingReference;

    public $firstName;

    public $middleName;

    public $lastName;

    public $dateOfBirth;

    public $ageInYears;

    public $ageClassification;

    public $gender;

    public $height;

    public $weight;

    public $countryId;

    public $passportNumber;

    public $email;

    public $phoneNumber;

    public $referralCode;

    public $referralChannelId;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentBackendUser(), 403);
    }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Step::make('Intro')
                    ->schema([
                        Fieldset::make('Entry')->schema([
                            TextInput::make('reference')
                                ->maxLength(255)
                                ->helperText('Reference number for the patient. Leave this blank and the system will generate one for you'),
                            Select::make('detailLevel')
                                ->options(PatientDataDetailEnum::class)
                                ->reactive()
                                ->helperText('How much data is required?')
                                ->required(),
                        ])->columns(2),
                    ]),
                Step::make('Patient Data')
                    ->schema([
                        Fieldset::make('Name')->schema([
                            TextInput::make('firstName')
                                ->required(),
                            TextInput::make('middleName'),
                            TextInput::make('lastName')
                                ->required(),
                        ])->columns(3),
                        Fieldset::make('Age')->schema([
                            DatePicker::make('dateOfBirth'),
                            TextInput::make('ageInYears')->integer(),
                            Select::make('ageClassification')
                                ->options(AgeClassificationEnum::class)
                                ->rules(['required_without_all:dateOfBirth,ageInYears']),
                        ])
                            ->columns(3),
                        Fieldset::make('Data')->schema([
                            Select::make('gender')
                                ->options(GenderEnum::class)
                                ->required(),
                            TextInput::make('height')
                                ->hidden(fn (\Filament\Forms\Get $get) => $get('detailLevel') != PatientDataDetailEnum::DETAILED->value)
                                ->integer()
                                ->helperText('Height in CM.'),
                            TextInput::make('weight')
                                ->hidden(fn (\Filament\Forms\Get $get) => $get('detailLevel') != PatientDataDetailEnum::DETAILED->value)
                                ->integer()
                                ->helperText('Weight in KG.'),
                        ])
                            ->columns(3),
                        Fieldset::make('Nationality')->schema([
                            Select::make('countryId')
                                ->options(Country::all()->toSelectArray())
                                ->searchable()
                                ->label('Nationality')
                                ->rules([
                                    function () {
                                        return function (string $attribute, $value, Closure $fail) {
                                            if ($this->detailLevel == PatientDataDetailEnum::DETAILED->value && empty($value)) {
                                                $fail("The {$attribute} is required at this level of detail.");
                                            }
                                        };
                                    },
                                ]),
                            TextInput::make('passportNumber')
                                ->maxLength(255)
                                ->rules([
                                    function () {
                                        return function (string $attribute, $value, Closure $fail) {
                                            if ($this->detailLevel == PatientDataDetailEnum::DETAILED->value && empty($value)) {
                                                $fail("The {$attribute} is required at this level of detail.");
                                            }
                                        };
                                    },
                                ]),
                        ])->hidden(fn (\Filament\Forms\Get $get) => $get('detailLevel') != PatientDataDetailEnum::DETAILED->value)
                            ->columns(2),
                        Fieldset::make('Contact')->schema([
                            TextInput::make('email')
                                ->email()
                                ->maxLength(255)
                                ->rules([
                                    function () {
                                        return function (string $attribute, $value, Closure $fail) {
                                            if ($this->detailLevel == PatientDataDetailEnum::DETAILED->value && empty($value)) {
                                                $fail("The {$attribute} is required at this level of detail.");
                                            }
                                        };
                                    },
                                ]),
                            TextInput::make('phoneNumber')
                                ->tel()
                                ->maxLength(255),
                        ])->hidden(fn (\Filament\Forms\Get $get) => $get('detailLevel') == PatientDataDetailEnum::NONE->value)
                            ->columns(2),
                    ]),
                Step::make('Referral')->schema([
                    Fieldset::make('Referral')->schema([
                        TextInput::make('referralCode')
                            ->maxLength(255),
                        Select::make('referralChannelId')
                            ->label('Referred By')
                            ->options(ReferralChannel::all()->toSelectArray())
                            ->searchable(),
                    ])->columns(2),
                ]),
            ])
                ->submitAction(view('filament.forms.components.wizard-submit-button')),
        ];
    }

    public function submitWizard(): void
    {
        try {
            $ageClassificationEnum = isset($this->dateOfBirth, $this->ageInYears) ? null : AgeClassificationEnum::tryFrom($this->ageClassification);
            $genderEnum = GenderEnum::tryFrom($this->gender);
            $parsedDateOfBirth = isset($this->dateOfBirth) ? Carbon::parse($this->dateOfBirth) : null;
            $parsedAgeInYears = isset($this->ageInYears) ? intval($this->ageInYears) : null;
            $parsedAgeInYears = isset($parsedDateOfBirth) ? null : $parsedAgeInYears; //prefer date of birth over age in years
            $parsedHeight = isset($this->height) ? intval($this->height) : null;
            $parsedWeight = isset($this->weight) ? intval($this->weight) : null;
            $parsedCountryId = isset($this->countryId) ? intval($this->countryId) : null;
            $parsedReferralChannelId = isset($this->referralChannelId) ? intval($this->referralChannelId) : null;
            $patient = (new CreatePatientAction())
                ->withReference($this->reference)
                ->withMiddleName($this->middleName)
                ->withHeight($parsedHeight)
                ->withWeight($parsedWeight)
                ->withAgeDetails($ageClassificationEnum, $parsedDateOfBirth, $parsedAgeInYears)
                ->withContactDetails($this->email, $this->phoneNumber)
                ->withCountryDetails($parsedCountryId, $this->passportNumber)
                ->withReferralDetails($parsedReferralChannelId, $this->referralCode)
                ->run($this->firstName, $this->lastName, $genderEnum);
            $this->notify('success', 'Registered patient successfully');
            $this->redirect(PatientResource::getUrl('view', ['record' => $patient->id]));
        } catch (\Exception $e) {
            $this->notify('danger', 'Something went wrong'.$e->getMessage());
        }
    }
}
