<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocalGovernmentArea extends BaseModel
{
    use HasFactory;

    //region CONFIG
    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = ['id'];
    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS

    //endregion

    //region SCOPES
    public function scopeIsReadyForSampleCollection($query)
    {
        return $query->where('is_ready_for_sample_collection', true);
    }
    //endregion

    //region RELATIONSHIPS
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    //endregion
}
