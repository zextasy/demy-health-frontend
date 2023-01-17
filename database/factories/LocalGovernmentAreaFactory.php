<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalGovernmentAreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = State::inRandomOrder()->first() ?? State::factory()->create();
        return [
            'name' => $this->faker->word,
            'state_id' => $parent->id,
            'is_ready_for_sample_collection' => $this->faker->boolean
        ];
    }
}
