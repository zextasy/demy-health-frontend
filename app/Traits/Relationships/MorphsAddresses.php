<?php

namespace App\Traits\Relationships;

use App\Models\Address;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait MorphsAddresses
{
    public function initializeMorphsAddresses()
    {
        $this->append('latest_address');
    }

    public function scopeInState($query, $stateId)
    {
        return $query->whereHas('addresses', function ($query) use ($stateId) {
            $query->where('state_id', '=', $stateId);
        });
    }

    public function scopeInLocalGovernmentArea($query, $localGovernmentAreaId)
    {
        return $query->whereHas('addresses', function ($query) use ($localGovernmentAreaId) {
            $query->where('local_government_area_id', '=', $localGovernmentAreaId);
        });
    }

    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    protected function latestAddress(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getLatestAddress(),
        );
    }

    protected function resolvedAddressText(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getResolvedAddressText(),
        );
    }

    public function getLatestAddress():?Address
    {
        return $this->addresses()->latest()->first();
    }

    public function getResolvedAddressText(): string
    {
        $resolvedAddress = $this->latest_address;
        if (empty($resolvedAddress)) {
            return 'Address Not Found!';
        }
        $nullableAddressLine2 = empty($resolvedAddress->line_2) ? '' : $resolvedAddress->line_2.', ';

        return $resolvedAddress->line_1.', '.$nullableAddressLine2.$resolvedAddress->city
            .', '.$resolvedAddress->localGovernmentArea->name.', '.$resolvedAddress->state->name;
    }
}
