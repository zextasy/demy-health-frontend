<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finance\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::factory(5)->create();
    }
}
