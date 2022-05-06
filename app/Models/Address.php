<?php

namespace App\Models;

use App\Models\CRM\CustomerEnquiry;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends BaseModel
{
    use HasFactory;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    public function state () : BelongsTo{
        return $this->belongsTo(State::class);
    }

    public function localGovernmentArea () : BelongsTo{
        return $this->belongsTo(LocalGovernmentArea::class);
    }

    public function users () : MorphToMany
    {
        return $this->morphedByMany(User::class,'addressable');
    }

    public function TestCenters () : MorphToMany
    {
        return $this->morphedByMany(TestCenter::class,'addressable');
    }

    public function TestBookings () : MorphToMany
    {
        return $this->morphedByMany(TestBooking::class,'addressable');
    }

    public function customerEnquiries () : MorphToMany
    {
        return $this->morphedByMany(CustomerEnquiry::class,'addressable');
    }
}
