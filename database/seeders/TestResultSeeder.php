<?php

namespace Database\Seeders;

use App\Models\TestResult;
use Illuminate\Database\Seeder;

class TestResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestResult::factory(10)->create();
    }
}
