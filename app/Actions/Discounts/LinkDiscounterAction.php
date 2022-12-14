<?php

namespace App\Actions\Discounts;

use App\Models\Finance\Discount;
use Illuminate\Support\Facades\DB;
use App\Contracts\DiscountContract;
use App\Models\Finance\FullDiscount;
use Illuminate\Database\Eloquent\Model;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use App\Exceptions\UnexpectedMatchValueException;

class LinkDiscounterAction
{

    public function run(int|Discount $discount, Model $discounter) : void
    {
        $discountId = $discount instanceof Discount ? $discount->id : $discount;
        $discounterId = $discounter->id;
        $discounterType = get_class($discounter);
        DB::table('discounters')
            ->insert(['discount_id' => $discountId, 'discounter_id' => $discounterId, 'discounter_type' => $discounterType]);

    }
}
