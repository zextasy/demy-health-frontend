<?php

namespace Database\Factories;

use App\Models\TestCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = TestCategory::inRandomOrder()->firstOrFail();
        return [
            'name' => $this->faker->word,
            'test_category_id' => $parent->id,
            'minimum_tat' => $this->faker->numberBetween(1, 3),
            'maximum_tat' => $this->faker->numberBetween(3, 10)
        ];
    }
}
