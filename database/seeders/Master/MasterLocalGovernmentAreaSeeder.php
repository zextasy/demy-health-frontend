<?php

namespace Database\Seeders\Master;

use Illuminate\Database\Seeder;

class MasterLocalGovernmentAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LGAs1TableSeeder::class);
        $this->call(LGAs2TableSeeder::class);
        $this->call(LGAs3TableSeeder::class);
        $this->call(LGAs4TableSeeder::class);
    }
}
