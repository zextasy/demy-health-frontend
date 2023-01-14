<?php

namespace Database\Seeders;

use App\Models\TestType;
use Illuminate\Database\Seeder;

class TestTypeSeeder extends Seeder
{

    public function run()
    {
        TestType::factory(25)->create();
    }
}
