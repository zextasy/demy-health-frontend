<?php

namespace Database\Seeders;

use App\Models\BusinessGroup;
use Illuminate\Database\Seeder;

class BusinessGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessGroup::factory()->count(10)->create();
    }
}
