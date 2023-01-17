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
        $parent = BusinessGroup::inRandomOrder()->first() ??
            BusinessGroup::create([
                'name' => 'Root',
                'description' => 'The Root Business Group for this Organisation',
                'order' => 0,
                ]);
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->words(5, true),
            'order' => $parent->order + 1,
            'parent_id' => $parent->id,
        ];
    }
}
