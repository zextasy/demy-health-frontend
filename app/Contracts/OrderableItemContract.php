<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface OrderableItemContract
{
    public function orderItems(): MorphMany;
}
