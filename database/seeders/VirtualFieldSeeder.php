<?php

namespace Database\Seeders;

use App\Models\VirtualField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VirtualFieldSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VirtualField::factory(25)->withOptions()->create();
    }
}
