<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    protected $productCategories = [
        'General', 'Consumables', 'Miscellaneous', 'PCR and Reagents', 'Hospital and Laboratory Products', 'Pharmaceuticals', 'Procurement and Supply',
    ];

    public function run()
    {
        foreach ($this->productCategories as $productCategory) {
            ProductCategory::updateOrCreate(['name' => $productCategory]);
        }
    }
}
