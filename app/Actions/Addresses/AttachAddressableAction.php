<?php

namespace App\Actions\Addresses;

use App\Models\Address;
use App\Contracts\AddressableContract;

class AttachAddressableAction
{


    public function run(int|Address $address, AddressableContract $addressable): bool
    {
        $addressable->addresses()->save($address);

        return true;
    }
}
