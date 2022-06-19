<?php

namespace App\Models;

use App\Models\BaseModel;
use Spatie\MediaLibrary\HasMedia;
use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Relationships\ReferencesUsersViaEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestResult extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, GeneratesReference, ReferencesUsersViaEmail;

//region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->test_result_prefix,
        ];
    }

    protected $guarded = ['id'];
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
//endregion

}
