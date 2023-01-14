<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Finance\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'model' => $this->faker->word,
            'country' => $this->faker->country,
        ];
    }

    public function configure()
    {
        $randomNumber = $this->faker->numberBetween(1, 1000000);
        return $this->afterCreating(function (Product $model) use ($randomNumber) {
            Price::factory()->create([
                'amount' => $randomNumber, 'priceable_id' => $model->id,'priceable_type' => get_class($model)
            ]);
        });
    }
}
