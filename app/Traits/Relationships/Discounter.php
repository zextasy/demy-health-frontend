<?php

namespace App\Traits\Relationships;

use App\Models\Task;
use App\Models\Finance\Discount;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Discounter
{
    public function discounts(): MorphToMany
    {
        return $this->MorphToMany(Discount::class, 'discounter');
    }
}
