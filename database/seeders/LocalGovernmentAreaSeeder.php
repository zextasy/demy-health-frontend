<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocalGovernmentAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Lgas_1_TableSeeder::class);
        $this->call(Lgas_2_TableSeeder::class);
        $this->call(Lgas_3_TableSeeder::class);
        $this->call(Lgas_4_TableSeeder::class);
    }
}
