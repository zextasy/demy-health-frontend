<?php

namespace Database\Seeders\Demy;

use Illuminate\Database\Seeder;

class DemyTestTypeSeeder extends Seeder
{

    public function run()
    {
        $this->call(DemyTestCategorySeeder::class);
    }
}
