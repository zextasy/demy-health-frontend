<?php

namespace App\Models;

use App\Traits\Relationships\HasAddresses;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends BaseModel
{
    use HasFactory, HasAddresses;
    //region CONFIG
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];
    protected $appends = ['is_ready_for_sample_collection'];
    //endregion

    //region ATTRIBUTES
    protected function isReadyForSampleCollection(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->localGovernmentAreasWithHomeSampleCollection->count() > 0,
        );
    }
    //endregion

    //region HELPERS

    //endregion

    //region SCOPES
    public function scopeIsReadyForSampleCollection($query)
    {
        return $query->whereHas('localGovernmentAreas', function ($subQuery) {
            return $subQuery->isReadyForSampleCollection();
        });
    }
    //endregion

    //region RELATIONSHIPS
    public function localGovernmentAreas(): HasMany
    {
        return $this->hasMany(LocalGovernmentArea::class);
    }

    public function localGovernmentAreasWithHomeSampleCollection(): HasMany
    {
        return $this->hasMany(LocalGovernmentArea::class)->isReadyForSampleCollection();
    }
    //endregion
}
