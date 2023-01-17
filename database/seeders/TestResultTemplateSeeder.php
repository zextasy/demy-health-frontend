<?php

namespace Database\Seeders;

use App\Models\TestResultTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestResultTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestResultTemplate::factory(5)->create();
    }
}
