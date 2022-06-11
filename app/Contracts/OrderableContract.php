<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface OrderableContract
{
    public function orders(): MorphMany;
}
