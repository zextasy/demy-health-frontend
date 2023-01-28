<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Contracts\DiscountContract;
use App\Traits\Models\LaravelMorphable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FullDiscount extends BaseModel implements DiscountContract
{
    use LaravelMorphable;

//region CONFIG
    protected $guarded = ['id'];
//endregion

//region ATTRIBUTES
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn () => DiscountTypeEnum::FULL,
        );
    }
    protected function discountValue(): Attribute
    {
        return Attribute::make(
            get: fn () => null,
        );
    }
//endregion

//region HELPERS
    public function getDiscountAmount(int|float $total): float
    {
        return floatval($total);
    }

    public function setDiscountValue(int|float $value): void
    {
        $this->refresh();
    }
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion

}
