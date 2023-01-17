<?php

namespace Database\Factories;

use App\Models\TestType;
use App\Models\TestCategory;
use App\Models\SpecimenType;
use App\Models\Finance\Price;
use App\Models\TestResultTemplate;
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
        $parent = TestCategory::inRandomOrder()->first() ?? TestCategory::factory()->create();
        $template = TestResultTemplate::inRandomOrder()->first() ?? TestResultTemplate::factory()->create();
        return [
            'name' => $this->faker->unique()->word,
            'test_category_id' => $parent->id,
            'minimum_tat' => $this->faker->numberBetween(1, 3),
            'maximum_tat' => $this->faker->numberBetween(3, 10),
            'test_result_template_id' => $template->id
        ];
    }

    public function configure()
    {
        $lowerLimit = 2;
        $upperLimit = 7;
        $randomNumber = $this->faker->numberBetween($lowerLimit, $upperLimit);
        $randomPrice = $this->faker->numberBetween(1, 100000);
        return $this->afterCreating(function (TestType $model) use ($randomPrice, $lowerLimit, $randomNumber) {
            Price::factory()->create([
                'amount' => $randomPrice, 'priceable_id' => $model->id,'priceable_type' => get_class($model)
            ]);
            $specimenTypes = SpecimenType::inRandomOrder()->limit($randomNumber)->get();
            if ($specimenTypes->count() < $lowerLimit) {
                $specimenTypes = SpecimenType::factory($randomNumber)->create();
            }
            $model->specimenTypes()->saveMany($specimenTypes);
        });
    }

}
