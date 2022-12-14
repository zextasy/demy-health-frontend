<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait SumsTotalAmountFromItems
{
    public function initializeSumsTotalAmountFromItemsTrait()
    {
        //FIXME this seems not to work for filament
        $this->append(['sub_total_amount','total_discount_amount','total_amount']);
    }
    protected function subTotalAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->sum('total_amount'),
        );
    }

    protected function totalDiscountAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getTotalDiscountAmount(),
        );
    }

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => max(($this->sub_total_amount - $this->total_discount_amount), 0),
        );
    }

    abstract private function getTotalDiscountAmount(): float;
}
