<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestCategorySeeder extends Seeder
{
    public function run()
    {
       $this->call(TestCategorySeeder1::class);
    }
}
