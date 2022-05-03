<?php

namespace App\Traits\Relationships;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasAddresses
{

    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    public function getLatestAddress()
    {
        return $this->addresses()->latest()->first();
    }

    public function getResolvedAddressTextAttribute():string
    {
        $resolvedAddress = $this->getLatestAddress();
        if (empty($resolvedAddress)){
            return "Address Not Found!";
        }
        return $resolvedAddress->line_1.', '.$resolvedAddress->line_2.', '.$resolvedAddress->localGovernmentArea->name.', '.$resolvedAddress->state->name;
    }
}
