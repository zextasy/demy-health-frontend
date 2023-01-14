<?php

namespace Database\Seeders;

use App\Models\TestCenter;
use Illuminate\Database\Seeder;

class TestCenterSeeder extends Seeder
{
    public function run()
    {
        TestCenter::factory(5)->create();
    }

}
