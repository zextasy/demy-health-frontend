<?php

namespace Database\Factories\Finance;

use App\Models\Product;
use App\Models\Finance\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finance\Price>
 */
class PriceFactory extends Factory
{
    protected $model = Price::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $parent = Product::inRandomOrder()->first() ?? Product::factory()->create();

        return [
            'amount' => $this->faker->numberBetween(1, 10000000),
            'start_date' => $this->faker->dateTimeBetween('-1 years'),
            'priceable_id' => $parent->id,
            'priceable_type' => get_class($parent),
        ];
    }
}
