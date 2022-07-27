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
        BusinessGroup::firstOrCreate([
            'name' => 'Root',
            'description' => 'The Root Business Group for this Organisation',
            'order' => 0,
        ]);
    }
}
