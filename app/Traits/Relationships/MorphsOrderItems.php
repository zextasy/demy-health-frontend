<?php

namespace App\Traits\Relationships;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsOrderItems
{

    public function orderItems(): MorphMany
    {
        return $this->MorphMany(OrderItem::class, 'orderable_item');
    }
}
