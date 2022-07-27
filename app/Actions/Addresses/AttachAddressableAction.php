<?php

namespace App\Actions\Addresses;

use App\Contracts\AddressableContract;
use App\Models\Address;

class AttachAddressableAction
{
    public function run(int|Address $address, AddressableContract $addressable): bool
    {
        $addressable->addresses()->save($address);

        return true;
    }
}
