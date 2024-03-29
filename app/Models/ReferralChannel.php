<?php

namespace App\Models;

use App\Models\Finance\Discount;
use App\Settings\GeneralSettings;
use Illuminate\Support\Collection;
use App\Contracts\DiscounterContract;
use App\Traits\Models\LaravelMorphable;
use App\Traits\Relationships\Discounter;
use App\Traits\Models\GeneratesReference;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ReferralChannel extends BaseModel implements DiscounterContract
{
    use HasFactory;
    use GeneratesReference;
    use Discounter;
    use LaravelMorphable;

    //region CONFIG
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'referral_code',
            'reference_prefix' => app(GeneralSettings::class)->referral_code_prefix,
        ];
    }
    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS
    public function getApplicableDiscounts(): Collection
    {
        return $this->discounts;
    }

    public function canApplyDiscount(?Discount $discount = null): bool
    {
        return app()->isLocal();
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function testBookings(): HasManyThrough
    {
        return $this->hasManyThrough(TestBooking::class, Patient::class);
    }
    //endregion
}
