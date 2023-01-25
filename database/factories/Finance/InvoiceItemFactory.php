<?php

namespace Database\Factories\Finance;

use App\Models\Order;
use App\Models\Product;
use App\Models\Finance\Invoice;
use App\Models\Finance\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finance\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    protected $model = InvoiceItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomProduct = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $parent = Invoice::inRandomOrder()->first() ?? Invoice::factory()->create();
        return [
            'invoice_id' => $parent->id,
            'name' => $randomProduct->getOrderableItemName(),
            'price' => $randomProduct->getInvoiceableItemPrice(),
            'quantity' => $this->faker->randomNumber(),
            'invoiceable_item_type' => $randomProduct->getLaravelMorphModelType(),
            'invoiceable_item_id' => $randomProduct->getLaravelMorphModelId()
        ];
    }
}
