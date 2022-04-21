<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function addressable () : MorphTo{
        return $this->morphTo('addressable');
    }
}
