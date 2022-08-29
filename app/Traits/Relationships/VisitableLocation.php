<?php

namespace App\Traits\Relationships;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait VisitableLocation
{
    public function visits(): MorphMany
    {
        return $this->MorphMany(Visit::class, 'visitable_location');
    }
}
