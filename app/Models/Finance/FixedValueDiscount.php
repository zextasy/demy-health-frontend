<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Contracts\DiscountContract;
use App\Traits\Models\LaravelMorphable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FixedValueDiscount extends BaseModel implements DiscountContract
{
    use LaravelMorphable;

//region CONFIG
    protected $guarded = ['id'];

    protected $casts =[
        'value' => 'float',
    ];
//endregion

//region ATTRIBUTES
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn () => DiscountTypeEnum::FIXED_VALUE,
        );
    }
    protected function discountValue(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->value),
        );
    }
//endregion

//region HELPERS
    public function getDiscountAmount(int|float $total): float
    {
        return $this->value;
    }
    public function setDiscountValue(int|float $value): void
    {
        $this->value = floatval($value);
        $this->save();
    }
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion


}
