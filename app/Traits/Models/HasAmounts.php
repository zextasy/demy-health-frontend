<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAmounts
{
    protected function formattedAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->amount),
        );
    }

}
