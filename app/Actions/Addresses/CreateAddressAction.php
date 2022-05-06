<?php

namespace App\Actions\Addresses;

use App\Models\Address;

class CreateAddressAction
{


    public function run($addressLine1, $addressLine2, $city, $stateId, $localGovernmentAreaId): Address
    {
        return Address::create([
            'line_1' => $addressLine1,
            'line_2' => $addressLine2,
            'city' => $city,
            'state_id' => $stateId,
            'local_government_area_id' => $localGovernmentAreaId,
        ]);
    }
}
