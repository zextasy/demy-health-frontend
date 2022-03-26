<?php

namespace App\Traits\Relationships;

use App\Models\TestBooking;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTestBookings
{

    public function TestBookings():HasMany
    {
        return $this->hasMany(TestBooking::class);
    }
}
