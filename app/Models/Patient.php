<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Enums\GenderEnum;
use Illuminate\Support\Carbon;
use App\Settings\GeneralSettings;
use App\Enums\AgeClassificationEnum;
use App\Traits\Models\GeneratesReference;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Relationships\MorphsAddresses;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Patient extends BaseModel
{
    use HasFactory, GeneratesReference, MorphsAddresses, BelongsToBusinessGroup;

    //region CONFIG
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at','date_of_birth'];
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
            get: fn () => $this->last_name . ' ' . $this->first_name,
        );
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
    //endregion

    //region SCOPES
    public function scopeWithCustomerDetails(Builder $query, string $identifier ): Builder
    {
        return $query->where('email', $identifier)
            ->orWhere('phone_number', $identifier);
    }
    //endregion

    //region RELATIONSHIPS
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function testBookings(): HasMany
    {
        return $this->hasMany(TestBooking::class);
    }

    public function testResults(): HasManyThrough
    {
        return $this->hasManyThrough(TestResult::class, TestBooking::class);
    }
    //endregion
}
