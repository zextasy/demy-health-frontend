<?php

namespace Database\Seeders\Demy;

use Illuminate\Database\Seeder;

class DemyTestCategorySeeder extends Seeder
{
    public function run()
    {
        $this->call(TestCategorySeeder1::class);
        $this->call(TestCategorySeeder2::class);
        $this->call(TestCategorySeeder3::class);
        $this->call(TestCategorySeeder4::class);
        $this->call(TestCategorySeeder5::class);
        $this->call(TestCategorySeeder6::class);
        $this->call(TestCategorySeeder7::class);
    }
}
