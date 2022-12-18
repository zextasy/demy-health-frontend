<?php

namespace App\Actions\Discounts;

use App\Models\Finance\Discount;
use Illuminate\Support\Facades\DB;
use App\Contracts\DiscountContract;
use App\Models\Finance\FullDiscount;
use App\Contracts\DiscounterContract;
use Illuminate\Database\Eloquent\Model;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use App\Exceptions\UnexpectedMatchValueException;

class LinkDiscounterAction
{

    public function run(int|Discount $discount, DiscounterContract $discounter) : void
    {
        $discountId = $discount instanceof Discount ? $discount->id : $discount;
        $discounterId = $discounter->getLaravelMorphModelId();
        $discounterType = $discounter->getLaravelMorphModelType();
        DB::table('discounters')->insert([
            'discount_id' => $discountId,
            'discounter_id' => $discounterId,
            'discounter_type' => $discounterType
        ]);

    }
}
