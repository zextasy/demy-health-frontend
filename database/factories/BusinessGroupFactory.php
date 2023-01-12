<?php

namespace Database\Factories;

use App\Models\BusinessGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessGroup>
 */
class BusinessGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $parent = BusinessGroup::inRandomOrder()->firstOrFail();
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->words,
            'order' => $parent->order + 1,
            'parent_id' => $parent->id,
        ];
    }
}
