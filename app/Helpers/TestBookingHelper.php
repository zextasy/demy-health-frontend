<?php

namespace App\Helpers;

use App\Models\Patient;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Actions\Patients\CreatePatientAction;
use App\Actions\Addresses\CreateAddressAction;
use App\Actions\Addresses\AttachAddressableAction;
use App\Actions\TestBookings\CreateTestBookingAction;

class TestBookingHelper
{
    public function getTestBookingFromCartItem(mixed $cartItem): TestBooking
    {
        $patientDetails = $cartItem->attributes->customerEmail ?? $cartItem->attributes->customerPhoneNumber;
        $testBookingPatient = Patient::withCustomerDetails($patientDetails)->first();
        if (empty($testBookingPatient)) {
            $customerDateOfBirth = isset($customerDateOfBirth) ?
                Carbon::parse($cartItem->attributes->customerDateOfBirth)
                : null;
            $testBookingPatient = (new CreatePatientAction)
                ->withContactDetails($cartItem->attributes->customerEmail, $cartItem->attributes->customerPhoneNumber)
                ->withAgeDetails(null, $customerDateOfBirth, null)
                ->withCountryDetails(
                    $cartItem->attributes->customerCountryId,
                    $cartItem->attributes->customerPassportNumber
                )
                ->run(
                    $cartItem->attributes->customerFirstName,
                    $cartItem->attributes->customerLastName,
                    $cartItem->attributes->customerGender
                );
        }
        $locationTypeEnum = LocationTypeEnum::from($cartItem->attributes->locationType);
        $dueDate = Carbon::parse($cartItem->attributes->dueDate);
        $testBooking = (new CreateTestBookingAction)
            ->atTestCenter($cartItem->attributes->selectedTestCenter)
            ->forPatient($testBookingPatient)
            ->withCustomerCommunicationDetails(
                $cartItem->attributes->customerEmail,
                $cartItem->attributes->customerPhoneNumber
            )
            ->run(
                $cartItem->attributes->selectedTestType,
                $locationTypeEnum,
                $dueDate
            );
        if ($locationTypeEnum == LocationTypeEnum::HOME) {
            $address = (new CreateAddressAction)->run(
                $cartItem->attributes->addressLine1,
                $cartItem->attributes->addressLine2,
                $cartItem->attributes->city,
                $cartItem->attributes->selectedLocalGovernmentArea,
                $cartItem->attributes->selectedState
            );
            (new AttachAddressableAction)->run($address, $testBooking);
        }

        return $testBooking;
    }
}
