<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = Country::inRandomOrder()->first() ??
            Country::create(['code' =>'COU','name' => 'Country','nationality' => 'Countrish']);
        return [
            'name' => $this->faker->word,
            'country_id' => $parent->id,
        ];
    }
}
