<?php

namespace App\Traits\Models;

trait HasAmounts
{
    public function getformattedAmountAttribute()
    {
        return number_format($this->amount);
    }
}
