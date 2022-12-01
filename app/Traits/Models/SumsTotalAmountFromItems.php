<?php

namespace App\Traits\Models;

trait SumsTotalAmountFromItems
{
    public function getTotalAmountAttribute(): float
    {
        return $this->items->sum('total_amount');
    }
}
