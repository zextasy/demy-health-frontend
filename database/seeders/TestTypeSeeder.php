<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestTypeSeeder extends Seeder
{
    protected $testTypes = [

    ];

    public function run()
    {
        $this->call(TestCategorySeeder::class);
    }
}
