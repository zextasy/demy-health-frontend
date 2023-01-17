<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Patient;
use App\Models\TestType;
use App\Enums\LocaleEnum;
use App\Models\TestCenter;
use App\Enums\TestBookings\LocationTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = TestType::inRandomOrder()->first() ?? TestType::factory()->create();
        $parent2 = Patient::inRandomOrder()->first() ?? Patient::factory()->create();
        $parent3 = TestCenter::inRandomOrder()->first() ?? TestCenter::factory()->create();
        return [
            'test_type_id' => $parent->id,
            'location_type' => isset($parent3) ? LocationTypeEnum::CENTER : LocationTypeEnum::HOME,
            'test_center_id' => $parent3?->id,
            'customer_email' => $parent2->email,
            'customer_phone_number' => $parent2->phone_number,
            'due_date' => $this->faker->dateTimeBetween('now', '+3 months'),
            'patient_id' => $parent2->id,
        ];
    }
}
