<?php

namespace Database\Seeders;

use App\Models\TestCenter;
use Illuminate\Database\Seeder;

class TestCenterSeeder extends Seeder
{
    protected $testCenters = [
        ['name' => 'DemyHealth Building', 'address' =>  "Plot 418A, Opposite D close, Along 1st Avenue, Gwarinpa, Abuja."],
        ['name' =>  'Chescon Park', 'address' => "Beside Millennium Garden, Opposite Transcorp Hilton, Maitama District, Abuja."],
        ['name' => 'Lagos Office', 'address' => "Plot 2, Aina Close, Beside Justrite Super Stores, Opposite New Page Plaza, Kosoko Road, Ojodu Berger, Lagos State."]
    ];//FIXME Add  cities and LGAs as relationships, or add an address model

    public function run()
    {
        foreach ($this->testCenters as $testCenter){
            TestCenter::updateOrCreate(['name' => $testCenter['name']], $testCenter);
        }
    }
}
