<?php

namespace App\Traits\Relationships;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAddress
{

    public function address(): MorphOne
    {
        return $this->MorphOne(Address::class, 'addressable');
    }
}
