<?php

namespace Database\Factories\Finance;

use App\Models\Finance\Invoice;
use App\Models\Finance\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Finance\Invoice>
 */
class InvoiceFactory extends Factory
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
        return $this->afterCreating(function (Invoice $model) use ($randomNumber) {
            InvoiceItem::factory($randomNumber)->create(['invoice_id' => $model->id]);
        });
    }

}
