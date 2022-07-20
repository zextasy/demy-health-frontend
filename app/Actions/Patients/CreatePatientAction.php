<?php

namespace App\Actions\Patients;
use App\Models\User;
use App\Models\Country;
use App\Models\TestType;
use App\Enums\GenderEnum;
use App\Models\TestCenter;
use App\Models\Patient;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use App\Events\TestBookedEvent;
use App\Models\ReferralChannel;
use App\Events\PatientAddedEvent;
use Illuminate\Support\Facades\DB;
use App\Enums\AgeClassificationEnum;

class CreatePatientAction {

    private ?string $reference = null;
    private ?string $middleName = null;
    private ?string $email = null;
    private ?string $phoneNumber = null;
    private ?string $passportNumber = null;
    private ?string $referralCode = null;
    private ?int $countryId = null;
    private ?int $referralChannelId = null;
    private ?int $height = null;
    private ?int $weight = null;
    private ?Carbon $dateOfBirth = null;
    private ?AgeClassificationEnum $ageClassificationEnum = null;
    private ?TestBooking $testBooking = null;
    private Patient $patient;

    public function run(string $firstName, string $lastName, int|GenderEnum $genderEnum = null) : Patient
    {
        if (isset($genderEnum)){
            $genderEnum = is_int($genderEnum) ? GenderEnum::from($genderEnum) : $genderEnum;
        }
        $this->patient  = Patient::make([
            'reference' => $this->reference,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $this->middleName,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'gender' => $genderEnum ?? GenderEnum::OTHER,
            'passport_number' =>  $this->passportNumber,
            'country_id' =>  $this->countryId,
            'date_of_birth' =>  $this->dateOfBirth,
            'age_classification' => $this->ageClassificationEnum ?? AgeClassificationEnum::UNKNOWN,
            'height' => $this->height,
            'weight' => $this->weight,
            'referral_channel_id' => $this->referralChannelId,
            'referral_code' => $this->referralCode,
        ]);

        DB::transaction(function () {
            $this->patient->save();

            if ($this->testBooking) {
                $this->testBooking->patient_id = $this->patient->id;
                $this->testBooking->save();
            }
        });

        $this->raiseEvents();
        return $this->patient;
    }

    public function withReference(?string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    public function withMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;
        return $this;
    }

    public function withHeight(?int $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function withWeight(?int $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function withAgeDetails(?AgeClassificationEnum $ageClassificationEnum, ?Carbon $dateOfBirth, ?int $ageInYears): self
    {
        $this->ageClassificationEnum = $ageClassificationEnum;
        $this->dateOfBirth = isset($ageInYears)? Carbon::now()->subYears($ageInYears) : $dateOfBirth;
        return $this;
    }

    public function withContactDetails(?string $email, ?string $phoneNumber): self
    {
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function withCountryDetails(Country|int|null $country, ?string $passportNumber): self
    {
        if (isset($country)){
            $this->countryId = $country instanceof Country ? $country->id : $country;
        }
        $this->passportNumber = $passportNumber;
        return $this;
    }

    public function withReferralDetails(ReferralChannel|int|null $referralChannel, ?string $referralCode): self
    {
        if (isset($referralChannel)){
            $this->referralChannelId = $referralChannel instanceof ReferralChannel ? $referralChannel->id : $referralChannel;
        }
        $this->referralCode = $referralCode;
        return $this;
    }

    private function raiseEvents()
    {
        PatientAddedEvent::dispatch($this->patient);
    }
}

