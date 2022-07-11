<?php

namespace App\Models;

use App\Contracts\AddressableContract;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\HasTestBookings;
use App\Traits\Relationships\MorphsContactDetails;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestCenter extends BaseModel implements AddressableContract
{
    use HasFactory, HasTestBookings, MorphsAddresses, MorphsContactDetails, BelongsToBusinessGroup;

    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];


}
