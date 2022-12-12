<?php

namespace App\Traits\Relationships;

use App\Models\Task;
use App\Models\Finance\Discount;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Discountable
{
    public function discounts(): MorphMany
    {
        return $this->MorphMany(Discount::class, 'discountable');
    }
}
