<?php

namespace Database\Factories;

use App\Models\TestType;
use App\Models\TestCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = TestCategory::inRandomOrder()->first();
        return [
            'name' => $this->faker->unique()->word,
            'test_category_id' => $parent?->id,
        ];
    }

    public function configure()
    {
        $randomNumber = $this->faker->numberBetween(1, 10);
        return $this->afterCreating(function (TestCategory $model) use ($randomNumber) {
            TestType::factory()->count($randomNumber)->create(['test_category_id' => $model->id]);
        });
    }
}
