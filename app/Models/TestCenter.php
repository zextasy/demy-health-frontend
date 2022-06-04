<?php

namespace App\Models;

use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\HasTestBookings;
use App\Traits\Relationships\MorphsContactDetails;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TestCenter extends BaseModel
{
    use HasFactory, HasTestBookings, MorphsAddresses, MorphsContactDetails;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];


}
