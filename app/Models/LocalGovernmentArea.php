<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGovernmentArea extends Model
{
    use HasFactory;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
