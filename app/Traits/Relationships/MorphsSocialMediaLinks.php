<?php

namespace App\Traits\Relationships;

use App\Models\SocialMediaLink;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsSocialMediaLinks
{
    public function socialMediaLinks(): MorphMany
    {
        return $this->MorphMany(SocialMediaLink::class, 'linkable');
    }
}
