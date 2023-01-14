<?php

namespace Database\Factories;

use App\Models\VirtualField;
use App\Models\TestResultTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestResultTemplate>
 */
class TestResultTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
        ];
    }

    public function configure()
    {
        $lowerLimit = 2;
        $upperLimit = 7;
        $randomNumber = $this->faker->numberBetween($lowerLimit, $upperLimit);
        return $this->afterCreating(function (TestResultTemplate $model) use ($lowerLimit, $randomNumber) {
            $virtualFields = VirtualField::inRandomOrder()->limit($randomNumber)->get();
            if ($virtualFields->count() < $lowerLimit) {
                $virtualFields = VirtualField::factory($randomNumber)->create();
            }
            $model->virtualFields()->saveMany($virtualFields);
        });
    }
}
