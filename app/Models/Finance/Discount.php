<?php

namespace App\Models\Finance;

use App\Models\Order;
use App\Models\Patient;
use App\Models\BaseModel;
use App\Models\ReferralChannel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->discount->getDiscountAmount($total);
    }

    public function hasBeenApplied(): bool
    {
        return $this->orders()->exists();
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

    public function orders(): BelongsToMany
    {
        return $this->morphedByMany(Order::class, 'discountable');
    }

    public function referralChannels(): MorphToMany
    {
        return $this->morphedByMany(ReferralChannel::class, 'discounter');
    }

    public function patients(): MorphToMany
    {
        return $this->morphedByMany(Patient::class, 'discounter');
    }
    //endregion

}
