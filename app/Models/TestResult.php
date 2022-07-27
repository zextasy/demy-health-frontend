<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\ReferencesUsersViaEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TestResult extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, GeneratesReference, ReferencesUsersViaEmail, BelongsToBusinessGroup;

    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->test_result_prefix,
        ];
    }

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];
    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS

    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function testBooking(): BelongsTo
    {
        return $this->belongsTo(TestBooking::class);
    }

    public function patient(): BelongsTo
    {
        return $this->testBooking->patient();
    }

    public function testType(): BelongsTo
    {
        return $this->testBooking->testType();
    }
    //endregion
}
