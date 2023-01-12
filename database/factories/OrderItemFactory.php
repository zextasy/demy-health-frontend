<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomProduct = Product::inRandomOrder()->firstOrFail();
        $parent = Order::inRandomOrder()->firstOrFail();
        return [
            'order_id' => $parent->id,
            'name' => $randomProduct->getOrderableItemName(),
            'price' => $randomProduct->getInvoiceableItemPrice(),
            'quantity' => $this->faker->randomNumber(),
            'orderable_item_type' => $randomProduct->getLaravelMorphModelType(),
            'orderable_item_id' => $randomProduct->getLaravelMorphModelId()
        ];
    }
}
