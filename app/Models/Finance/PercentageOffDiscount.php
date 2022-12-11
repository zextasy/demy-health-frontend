<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Contracts\DiscountContract;
use App\Traits\Models\LaravelMorphable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PercentageOffDiscount extends BaseModel implements DiscountContract
{
    use HasFactory;
    use LaravelMorphable;

//region CONFIG
    protected $guarded = ['id'];

    protected $casts =[
        'percent_off' => 'float',
    ];
//endregion

//region ATTRIBUTES
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn () => DiscountTypeEnum::PERCENTAGE_OFF,
        );
    }
    protected function discountValue(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->percent_off.' %',
        );
    }
//endregion

//region HELPERS
    public function getDiscountAmount(int|float $total): float
    {
        $total = floatval($total);
        return $total * ($this->percent_off / 100);
    }

    public function setDiscountValue(int|float $value): void
    {
        $this->percent_off = floatval($value);
        $this->save();
    }
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion

}
