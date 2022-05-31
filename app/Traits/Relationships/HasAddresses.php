<?php

namespace App\Traits\Relationships;

use App\Models\User;
use App\Models\Address;
use App\Models\TestCenter;
use App\Models\TestBooking;
use App\Models\Pivots\Addressable;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

trait HasAddresses
{
    use HasRelationships;

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function testBookings(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations($this->addresses(),(new Address)->testBookings());
    }

    public function testCenters(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations($this->addresses(),(new Address)->testCenters());
    }

    public function users(): HasManyDeep
    {
        return $this->hasManyDeepFromRelations($this->addresses(),(new Address)->users());
    }
}
