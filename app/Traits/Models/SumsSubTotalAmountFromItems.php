<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait SumsSubTotalAmountFromItems
{
    public function initializeSumsSubTotalAmountFromItems()
    {
        $this->append(['sub_total_amount','total_discount_amount','total_amount']);
    }
    protected function subTotalAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->sum('total_amount'),
        );
    }

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getTotalAmount(),
        );
    }

    abstract private function getTotalAmount(): float;
}
