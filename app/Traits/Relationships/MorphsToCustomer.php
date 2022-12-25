<?php

namespace App\Traits\Relationships;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait MorphsToCustomer
{
    public function customer(): MorphTo
    {
        return $this->morphTo('customer');
    }
}
