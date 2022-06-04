<?php

namespace App\Traits\Relationships;

use App\Models\ContactDetail;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsContactDetails
{

    public function contactDetails(): MorphMany
    {
        return $this->MorphMany(ContactDetail::class, 'contactable');
    }
}
