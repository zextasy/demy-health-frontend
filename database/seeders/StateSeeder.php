<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryId = Country::where('name', 'Nigeria')->firstOrFail()->id;

        DB::table('states')->insert([
            'name' => 'Abia',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Adamawa',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Akwa-Ibom',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Anambra',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Bauchi',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Bayelsa',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Benue',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Borno',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Cross-River',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Delta',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Ebonyi',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Edo',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Ekiti',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Enugu',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Gombe',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Imo',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Jigawa',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Kaduna',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Kano',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Katsina',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Kebbi',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Kogi',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Kwara',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Lagos',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Nasarrawa',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Niger',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Ogun',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Ondo',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Osun',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Oyo',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Plateau',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Rivers',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Sokoto',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Taraba',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Yobe',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'Zamfara',
            'country_id' => $countryId,
        ]);

        DB::table('states')->insert([
            'name' => 'FCT',
            'country_id' => $countryId,
        ]);
    }
}
