<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Discount;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Discountable
{
    public function discounts(): MorphToMany
    {
        return $this->MorphToMany(Discount::class, 'discountable');
    }
}
