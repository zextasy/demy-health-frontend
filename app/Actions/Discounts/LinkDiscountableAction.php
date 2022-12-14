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

class LinkDiscountableAction
{

    public function run(int|Discount $discount, Model $discountable) : void
    {
        $discountId = $discount instanceof Discount ? $discount->id : $discount;
        $discountableId = $discountable->id;
        $discountableType = get_class($discountable);
        DB::table('discountables')
            ->insert(['discount_id' => $discountId, 'discountable_id' => $discountableId, 'discountable_type' => $discountableType]);

    }
}
