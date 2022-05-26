<?php

namespace App\Traits\Relationships;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsOrders
{

    public function orders(): MorphMany
    {
        return $this->MorphMany(Order::class, 'orderable');
    }
}
