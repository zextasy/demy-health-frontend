<?php

namespace Database\Seeders;

use App\Models\SpecimenType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecimenTypeSeeder  extends Seeder
{

    public function run()
    {
        SpecimenType::factory(10)->create();
    }
}
