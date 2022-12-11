<?php

namespace App\Actions\Discounts;

use App\Models\Finance\Discount;
use Illuminate\Support\Facades\DB;
use App\Contracts\DiscountContract;
use App\Models\Finance\FullDiscount;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use App\Exceptions\UnexpectedMatchValueException;

class UpdateDiscountAction
{


    private ?string $name = null;
    private ?string $code = null;

    public function execute(int|Discount $discount, ?float $value) : Discount
    {
        $discount = $discount instanceof Discount ? $discount : Discount::findOrFail($discount);

        return DB::transaction(function () use ($value, $discount) {
            if (isset($value)) {
                $discount->discount->setDiscountValue($value);
            }
            if (isset($this->code)) {
                $discount->code = $this->code;
            }
            if (isset($this->name)) {
                $discount->name = $this->name;
            }
             $discount->save();
             return $discount;

         });
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }
}
