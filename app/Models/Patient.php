<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Enums\GenderEnum;
use Illuminate\Support\Carbon;
use App\Settings\GeneralSettings;
use App\Enums\AgeClassificationEnum;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\MorphsAddresses;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
            get: fn ($value) => $this->calculateAge(),
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

    //endregion

    //region RELATIONSHIPS
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }

    public function testBookings(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }
    //endregion
}
