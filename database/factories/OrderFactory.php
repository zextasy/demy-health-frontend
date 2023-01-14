<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_email' => $this->faker->email,
        ];
    }

    public function configure()
    {
        $randomNumber = $this->faker->numberBetween(1, 5);
        return $this->afterCreating(function (Order $model) use ($randomNumber) {
            OrderItem::factory($randomNumber)->create(['order_id' => $model->id]);
        });
    }
}
