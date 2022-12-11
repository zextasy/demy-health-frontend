<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends BaseModel
{
    use HasFactory;

    //region CONFIG
    protected $guarded = ['id'];
    protected $with = ['discount'];
    protected $appends = ['type','discount_value'];
    //endregion

    //region ATTRIBUTES
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->discount->type,
        );
    }
    protected function discountValue(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->discount->discount_value,
        );
    }
    //endregion

    //region HELPERS

    public static function findByCode(string $code): ?BaseModel
    {
        return self::query()->where('code', $code)->first();
    }

    public function getDiscountAmount(int|float $total): float
    {
        return $this->discount->getDiscountAmount();
    }

    public function hasBeenApplied(): bool
    {
        return true;
    }

    public function hasNotBeenApplied(): bool
    {
        return !$this->hasBeenApplied();
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function discount(): MorphTo
    {
        return $this->morphTo();
    }
    //endregion

}
