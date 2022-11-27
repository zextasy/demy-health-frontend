<?php

namespace App\Traits\Models;

trait CalculatesTotalAmount
{
    public function getTotalAmountAttribute(): float
    {
        return $this->price * $this->quantity;
    }
}
