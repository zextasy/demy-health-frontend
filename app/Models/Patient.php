<?php

namespace App\Models;

use App\Enums\GenderEnum;
use Illuminate\Support\Carbon;
use App\Models\Finance\Discount;
use App\Contracts\PayerContract;
use App\Settings\GeneralSettings;
use Illuminate\Support\Collection;
use App\Enums\AgeClassificationEnum;
use App\Contracts\DiscounterContract;
use App\Traits\Models\LaravelMorphable;
use App\Traits\Relationships\Discounter;
use App\Traits\Models\GeneratesReference;
use App\Contracts\ActiveCustomerContract;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\HasOrdersViaEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Relationships\HasInvoicesViaEmail;
use App\Traits\Relationships\HasPaymentsViaEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\ReferencesUsersViaEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Patient extends BaseModel implements DiscounterContract, ActiveCustomerContract, PayerContract
{
    use HasFactory;
    use GeneratesReference;
    use MorphsAddresses;
    use BelongsToBusinessGroup;
    use ReferencesUsersViaEmail;
    use Discounter;
    use LaravelMorphable;
    use HasOrdersViaEmail;
    use HasInvoicesViaEmail;
    use HasPaymentsViaEmail;

    //region CONFIG
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'date_of_birth'];

    protected $casts = [
        'gender' => GenderEnum::class,
        'age_classification' => AgeClassificationEnum::class,
    ];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->patient_prefix,
        ];
    }
    //endregion

    //region ATTRIBUTES

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->calculateAge(),
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFullName(),
        );
    }

    public function getFullName():string
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function getEmailForPayment(): ?string
    {
        return $this->email;
    }
    //endregion

    //region HELPERS
    public function resolveAgeClassification(int|Carbon $age): AgeClassificationEnum
    {
        $age = $age instanceof Carbon ? $age->age : $age;

        return AgeClassificationEnum::getClassificationFromAge($age);
    }

    public function calculateAge(): string
    {
        $age = 'Unkown';
        if (isset($this->date_of_birth)) {
            return $this->date_of_birth->age;
        }

        if (isset($this->age_classification)) {
            return $this->age_classification->key;
        }

        return $age;
    }

    public function getApplicableDiscounts(): Collection
    {
        $discounts = $this->discounts;
        if (isset($this->referredBy)) {
            $discounts = $discounts->merge($this->referredBy?->discounts);
        }
        return $discounts;
    }

    public function canApplyDiscount(?Discount $discount = null): bool
    {
        return app()->isLocal();
    }
    //endregion

    //region SCOPES
    public function scopeWithCustomerDetails($query, string $identifier)
    {
        return $query->where('email', $identifier)
            ->orWhere('phone_number', $identifier);
    }
    //endregion

    //region RELATIONSHIPS

    public function testBookings(): HasMany
    {
        return $this->hasMany(TestBooking::class);
    }

    public function testResults(): HasManyThrough
    {
        return $this->hasManyThrough(TestResult::class, TestBooking::class);
    }

    public function referredBy(): BelongsTo
    {
        return $this->belongsTo(ReferralChannel::class, 'referral_channel_id');
    }
    //endregion

}
