<?php

namespace Database\Seeders;

use App\Enums\ContactDetails\ContactDetailTypeEnum;
use App\Models\Address;
use App\Models\LocalGovernmentArea;
use App\Models\State;
use App\Models\TestCenter;
use Illuminate\Database\Seeder;

class TestCenterSeeder extends Seeder
{
    public function run()
    {
        $stateAbuja = State::where('name', 'FCT')->first();
        $stateLagos = State::where('name', 'Lagos')->first();
        $stateRivers = State::where('name', 'Rivers')->first();
        $lgaMunicipal = LocalGovernmentArea::where('name', 'Abuja Municipal')->first();
        $lgaIkeja = LocalGovernmentArea::where('name', 'Ikeja')->first();
        $lgaPH = LocalGovernmentArea::where('name', 'Port-Harcourt')->first();

        $testCenter = TestCenter::create([
            'name' => 'DemyHealth Building',
            'offers_home_collection' => true,
        ]);
        $address = Address::create([
            'line_1' => 'Plot 418A, Opposite D close',
            'line_2' => 'Along 1st Avenue',
            'city' => 'Gwarinpa',
            'state_id' => $stateAbuja->id,
            'local_government_area_id' => $lgaMunicipal->id,
        ]);

        $address->TestCenters()->save($testCenter);

        $testCenter = TestCenter::create([
            'name' => 'Chescon Park',
            'offers_home_collection' => true,
        ]);
        $address = Address::create([
            'line_1' => 'Beside Millennium Garden',
            'line_2' => 'Opposite Transcorp Hilton',
            'city' => 'Maitama District',
            'state_id' => $stateAbuja->id,
            'local_government_area_id' => $lgaMunicipal->id,
        ]);

        $address->TestCenters()->save($testCenter);

        $testCenter = TestCenter::create([
            'name' => 'Lagos Office',
            'offers_home_collection' => true,
        ]);
        $address = Address::create([
            'line_1' => 'Plot 2, Aina Close, Beside Justrite Super Stores',
            'line_2' => 'Opposite New Page Plaza, Kosoko Road',
            'city' => 'Ojodu Berger',
            'state_id' => $stateLagos->id,
            'local_government_area_id' => $lgaIkeja->id,
        ]);

        $address->TestCenters()->save($testCenter);

        $testCenter = TestCenter::create([
            'name' => 'PathConsults Clinical labs and forensics',
            'offers_home_collection' => true,
        ]);
        $address = Address::create([
            'line_1' => '6B UDOM CLOSE',
            'line_2' => 'behind old Nitel, Garrison bustop area',
            'city' => 'Port Harcourt',
            'state_id' => $stateRivers->id,
            'local_government_area_id' => $lgaPH->id,
        ]);

        $address->TestCenters()->save($testCenter);
        $testCenter->contactDetails()->create([
            'description' => 'primary phone',
            'details' => '08062622296',
            'type' => ContactDetailTypeEnum::PHONE->value,
        ]);
        $testCenter->contactDetails()->create([
            'description' => 'primary phone',
            'details' => '08062622296',
            'type' => ContactDetailTypeEnum::PHONE->value,
        ]);
        $testCenter->contactDetails()->create([
            'description' => 'secondary phone',
            'details' => '09068059263',
            'type' => ContactDetailTypeEnum::PHONE->value,
        ]);
        $testCenter->contactDetails()->create([
            'description' => 'primary email',
            'details' => 'pathconsults2020@gmail.com',
            'type' => ContactDetailTypeEnum::EMAIL->value,
        ]);
    }
}
