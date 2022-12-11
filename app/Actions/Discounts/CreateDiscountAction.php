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

class CreateDiscountAction
{


    public function execute(DiscountTypeEnum $discountTypeEnum, string $code, string $name, ?float $value) : Discount
    {
        return DB::transaction(function () use ($value, $name, $code, $discountTypeEnum) {
             $childDiscount = $this->createChildDiscount($discountTypeEnum, $value);
             $discount = new Discount();
             $discount->code = $code;
             $discount->name = $name;
             $discount->discount_id = $childDiscount->getLaravelMorphModelId();
            $discount->discount_type = $childDiscount->getLaravelMorphModelType();
             ray($childDiscount, $discount);
             $discount->save();
             return $discount;

         });
    }

    /**
     * @throws UnexpectedMatchValueException
     */
    private function createChildDiscount(DiscountTypeEnum $discountTypeEnum, ?float $value): DiscountContract
    {
        return match ($discountTypeEnum->name) {
            DiscountTypeEnum::FIXED_VALUE->name => $this->createFixedValueDiscount($value),
            DiscountTypeEnum::PERCENTAGE_OFF->name => $this->createPercentageOffDiscount($value),
            DiscountTypeEnum::FULL->name => $this->createFullDiscount(),
            default => throw new UnexpectedMatchValueException(),
        };
    }

    private function createFixedValueDiscount(float $value): FixedValueDiscount
    {
        return FixedValueDiscount::create(['value' => $value]);
    }

    private function createPercentageOffDiscount(float $value): PercentageOffDiscount
    {
        return PercentageOffDiscount::create(['percent_off' => $value]);
    }

    private function createFullDiscount(): FullDiscount
    {
        return FullDiscount::create([]);
    }
}
