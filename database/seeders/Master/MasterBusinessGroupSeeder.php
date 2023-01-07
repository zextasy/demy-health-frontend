<?php

namespace Database\Seeders\Master;

use App\Models\BusinessGroup;
use Illuminate\Database\Seeder;

class MasterBusinessGroupSeeder extends Seeder
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
