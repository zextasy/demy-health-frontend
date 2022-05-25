<?php

namespace App\Traits\Relationships;

use App\Models\User;
use App\Models\Address;
use App\Models\TestCenter;
use App\Models\TestBooking;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasAddresses
{

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function TestBookings(): HasManyThrough
    {
        return $this->hasManyThrough(TestBooking::class, Address::class);
    }

    public function TestCenters(): HasManyThrough
    {
        //TODO implement hasmanydeep on all 3 relationships and retest. check stackoverflow - hasmanythrough morph
        return $this->hasManyThrough(TestCenter::class, Address::class);
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Address::class);
    }
}
