<?php

namespace Database\Factories;

use App\Models\TestBooking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestResult>
 */
class TestResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $parent = TestBooking::inRandomOrder()->firstOrFail();
        return [
            'test_booking_id' => $parent->id,
            'customer_email' => $parent->customer_email,
            'customer_phone_number' => $parent->customer_phone_number
        ];
    }
}
