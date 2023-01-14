<?php

namespace Database\Seeders;

use App\Models\TestCategory;
use Illuminate\Database\Seeder;

class TestCategorySeeder extends Seeder
{
    public function run()
    {
        TestCategory::factory(10)->create();
    }
}
