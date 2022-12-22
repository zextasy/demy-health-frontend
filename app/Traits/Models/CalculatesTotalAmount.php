<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CalculatesTotalAmount
{

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getTotalAmount(),
        );
    }

    abstract protected function getTotalAmount(): float;
}
