<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\TestCategory;
use App\Models\Finance\Price;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = ProductCategory::inRandomOrder()->first();
        return [
            'name' => $this->faker->unique()->word,
            'product_category_id' => $parent?->id,
        ];
    }

    public function configure()
    {
        $randomNumber = $this->faker->numberBetween(1, 10);
        return $this->afterCreating(function (ProductCategory $model) use ($randomNumber) {
            $products = Product::factory()->count($randomNumber)->create();
            $model->products()->saveMany($products);
        });
    }
}
