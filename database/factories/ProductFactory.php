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

//    public function configure()
//    {
//        $randomNumber = $this->faker->numberBetween(1, 10000000);
//        return $this->afterMaking(function (Product $model) use ($randomNumber) {
//            $model->setPrice($randomNumber);
//        })->afterCreating(function (Product $model) use ($randomNumber) {
//            $model->fresh();
//            $model->setPrice($randomNumber);
//        });
//    }
}
