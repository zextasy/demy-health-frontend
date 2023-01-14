<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{

    public function run()
    {
        $this->call(DatabaseSeeder::class);
        $this->call(VirtualFieldSeeder::class);
        $this->call(TestCenterSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TestTypeSeeder::class);
    }
}
