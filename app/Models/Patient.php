<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\MorphsAddresses;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends BaseModel
{
    use HasFactory, GeneratesReference, MorphsAddresses, BelongsToBusinessGroup;

//region CONFIG
    protected $guarded = ['id'];
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->patient_prefix,
        ];
    }
//endregion

//region ATTRIBUTES

//endregion

//region HELPERS

//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function testResults() : HasMany
    {
        return $this->hasMany(TestResult::class);
    }

    public function testBookings() : HasMany
    {
        return $this->hasMany(TestResult::class);
    }
//endregion
}
