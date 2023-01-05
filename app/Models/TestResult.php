<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\Models\GeneratesReference;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Relationships\BelongsToActiveCustomerViaCustomerEmail;

class TestResult extends BaseModel implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use GeneratesReference;
    use BelongsToActiveCustomerViaCustomerEmail;
    use BelongsToBusinessGroup;

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

    public function testType(): BelongsTo
    {
        return $this->testBooking->testType();
    }
    //endregion
}
