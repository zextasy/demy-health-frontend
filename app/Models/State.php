<?php

namespace App\Models;

use App\Traits\Relationships\HasAddresses;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends BaseModel
{
    use HasFactory, HasAddresses;

    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];

    public function localGovernmentAreas(): HasMany
    {
        return $this->hasMany(LocalGovernmentArea::class);
    }

}
