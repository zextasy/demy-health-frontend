<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    protected $productCategories = [
        'General', 'Consumables', 'Miscellaneous','PCR and Reagents', 'Hospital and Laboratory Products', 'Pharmaceuticals', 'Procurement and Supply'
    ];
    public function run()
    {
        foreach ($this->productCategories as $productCategory) {
            ProductCategory::updateOrCreate(['name' => $productCategory]);
        }
    }
}
