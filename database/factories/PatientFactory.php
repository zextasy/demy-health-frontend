<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->userName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'gender' => $this->faker->randomElement(GenderEnum::values()),
            'passport_number' => $this->faker->swiftBicNumber,
            'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-1 month'),
            'height' => $this->faker->numberBetween(6, 200),
            'weight' => $this->faker->numberBetween(6, 200)
        ];
    }
}
