<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\TestCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'offers_home_collection' => $this->faker->boolean
        ];
    }

    public function configure()
    {

        return $this->afterCreating(function (TestCenter $model) {
            $address = Address::factory()->create();
            $model->addresses()->save($address);
        });
    }
}
