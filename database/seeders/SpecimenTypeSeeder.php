<?php

namespace Database\Seeders;

use App\Models\SpecimenType;
use Illuminate\Database\Seeder;

class SpecimenTypeSeeder extends Seeder
{
    private $specimens = [
        ['key' => 'G', 'description' => 'SST/Plain/Gold cap bottle'],
        ['key' => 'P', 'description' => 'EDTA/Purple cap bottle'],
        ['key' => 'B', 'description' => 'Citrate/Blue cap bottle'],
        ['key' => 'H', 'description' => 'Heparin Lithium/Green cap bottle'],
        ['key' => 'F', 'description' => 'Fluoride Oxalate/Grey cap bottle'],
        ['key' => 'U', 'description' => 'Universal bottle'],
        ['key' => 'S', 'description' => 'Stool Universal bottle'],
        ['key' => 'SW', 'description' => 'Swab'],
        ['key' => 'BSW', 'description' => 'Buccal Swap'],
        ['key' => 'BC', 'description' => 'Blood Culture bottle'],
        ['key' => 'LBC', 'description' => 'Liquid base Cytology Kit'],
        ['key' => 'SP', 'description' => 'Special bottle'],
        ['key' => 'H & T', 'description' => 'Hair or tissue (for cadavers above 36 hours)']
    ];
    public function run()
    {
        foreach ($this->specimens as $specimen) {
            SpecimenType::updateOrCreate($specimen);
        }
    }
}
