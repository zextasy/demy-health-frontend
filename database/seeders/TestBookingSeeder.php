<?php

namespace Database\Seeders;

use App\Models\TestBooking;
use Illuminate\Database\Seeder;

class TestBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestBooking::factory(20)->create();
    }
}
