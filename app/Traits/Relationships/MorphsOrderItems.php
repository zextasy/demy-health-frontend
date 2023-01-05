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

    public function orderHasBeenPlaced(): bool
    {
        return  $this->orderItems()->exists();
    }

    public function orderHasNotBeenPlaced(): bool
    {
        return  !$this->hasBeenInvoiced();
    }
}
