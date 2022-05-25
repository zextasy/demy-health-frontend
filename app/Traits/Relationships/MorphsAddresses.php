<?php

namespace App\Traits\Relationships;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait MorphsAddresses
{
    public function initializeHasAddressesTrait()
    {
        $this->append('latest_address');
    }

    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    public function getLatestAddressAttribute()
    {
        return $this->addresses()->latest()->first();
    }

    public function getResolvedAddressTextAttribute():string
    {
        $resolvedAddress = $this->latest_address;
        if (empty($resolvedAddress)){
            return "Address Not Found!";
        }
        $nullableAddressLine2 = empty($resolvedAddress->line_2) ? '': $resolvedAddress->line_2.', ';
        return $resolvedAddress->line_1.', '.$nullableAddressLine2.$resolvedAddress->city.', '.$resolvedAddress->localGovernmentArea->name.', '.$resolvedAddress->state->name;
    }
}
