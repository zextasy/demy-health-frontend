<?php

namespace App\Actions\TestBookings;
use App\Models\User;
use App\Models\TestType;
use App\Models\TestCenter;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use App\Events\TestBookedEvent;
use Illuminate\Support\Facades\DB;
use App\Enums\TestBooking\LocationTypeEnum;

class CreateTestBookingAction {


    private ?int $userId = null;
    private ?int $testCenterId = null;
    private TestBooking $testBooking;

    public function run(TestType|int $testType, string $customerEmail, LocationTypeEnum $locationTypeEnum, Carbon $dueDate) : TestBooking
    {
        $testTypeId = $testType instanceof TestType ? $testType->id : $testType;
        $this->testBooking  = TestBooking::make([
            'test_type_id' => $testTypeId,
            'user_id' => $this->userId,
            'customer_email' => $customerEmail,
            'location_type' => $locationTypeEnum,
            'test_center_id' => $this->testCenterId,
            'due_date' =>  $dueDate,
        ]);

        DB::transaction(function () {
            $this->testBooking->save();
        });

        $this->raiseEvents();
        return $this->testBooking;
    }

    public function atTestCenter(TestCenter|int|null $testCenter): CreateTestBookingAction
    {
        if (isset($testCenter)){
            $this->testCenterId = $testCenter instanceof TestCenter ? $testCenter->id : $testCenter;
        }

        return $this;
    }

    public function forUser(User|int|null $user): CreateTestBookingAction
    {
        if (isset($user)){
            $this->userId = $user instanceof User ? $user->id : $user;
        }

        return $this;
    }

    private function raiseEvents()
    {
        TestBookedEvent::dispatch($this->testBooking);
    }
}

