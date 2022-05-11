<?php

namespace App\Actions\TestBookings;
use App\Models\User;
use App\Models\TestType;
use App\Models\TestCenter;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use App\Enums\TestBooking\LocationTypeEnum;

class CreateTestBookingAction {


    private ?int $userId = null;
    /**
     * @var TestCenter|int|mixed
     */
    private ?int $testCenterId;

    public function run(TestType|int $testType, string $customerEmail, LocationTypeEnum $locationTypeEnum, Carbon $dueDate) : TestBooking
    {
        $testTypeId = $testType instanceof TestType ? $testType->id : $testType;
        return TestBooking::create([
            'test_type_id' => $testTypeId,
            'user_id' => $this->userId,
            'customer_email' => $customerEmail,
            'location_type' => $locationTypeEnum,
            'test_center_id' => $this->testCenterId,
            'due_date' =>  $dueDate,
        ]);
    }

    public function atTestCenter(TestCenter|int|null $testCenter): CreateTestBookingAction
    {
        if (isset($testCenter)){
            $this->testCenterId = $testCenter instanceof TestCenter ? $testCenter->id : $testCenter;
        }

        return $this;
    }
}

