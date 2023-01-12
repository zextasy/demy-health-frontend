<?php

namespace Database\Factories;

use App\Models\State;
use App\Models\LocalGovernmentArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lga = LocalGovernmentArea::inRandomOrder()->firstOrFail();
        return [
            'line_1' => $this->faker->streetAddress,
            'line_2' => $this->faker->address,
            'city' => $this->faker->city,
            'state_id' => $lga->state_id,
            'local_government_area_id' => $lga->id,
        ];
    }
}
