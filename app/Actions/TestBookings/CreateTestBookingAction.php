<?php

namespace App\Actions\TestBookings;

use App\Enums\TestBookings\LocationTypeEnum;
use App\Events\TestBookedEvent;
use App\Models\Patient;
use App\Models\TestBooking;
use App\Models\TestCenter;
use App\Models\TestType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CreateTestBookingAction
{
    private ?Patient $patient = null;

    private ?int $testCenterId = null;

    private TestBooking $testBooking;

    private ?string $customerEmail;

    private ?string $customerPhoneNumber;

    public function run(TestType|int $testType, LocationTypeEnum $locationTypeEnum, Carbon $dueDate): TestBooking
    {
        $testTypeId = $testType instanceof TestType ? $testType->id : $testType;
        $this->testBooking = TestBooking::make([
            'test_type_id' => $testTypeId,
            'location_type' => $locationTypeEnum,
            'patient_id' => $this->patient->id,
            'customer_email' => $this->customerEmail ?? $this->patient?->email,
            'customer_phone_number' => $this->customerPhoneNumber?? $this->patient?->phone_number,
            'test_center_id' => $this->testCenterId,
            'due_date' => $dueDate,
        ]);

        DB::transaction(function () {
            $this->testBooking->save();
        });

        $this->raiseEvents();

        return $this->testBooking;
    }

    public function atTestCenter(TestCenter|int|null $testCenter): self
    {
        if (isset($testCenter)) {
            $this->testCenterId = $testCenter instanceof TestCenter ? $testCenter->id : $testCenter;
        }

        return $this;
    }

    public function forPatient(Patient|int|null $patient): self
    {
        if (isset($patient)) {
            $this->patient = $patient instanceof Patient ? $patient : Patient::find($patient);
        }

        return $this;
    }

    public function withCustomerCommunicationDetails(?string $customerEmail, ?string $customerPhoneNumber): self
    {
        $this->customerEmail = $customerEmail;
        $this->customerPhoneNumber = $customerPhoneNumber;

        return $this;
    }

    private function raiseEvents()
    {
        TestBookedEvent::dispatch($this->testBooking);
    }
}
