<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use Spatie\MediaLibrary\HasMedia;
use Stancl\VirtualColumn\VirtualColumn;
use App\Traits\Models\GeneratesReference;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Models\CanBeApprovedByUsers;
use App\Traits\Models\CanBeRejectedByUsers;
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
    use VirtualColumn;
    use CanBeApprovedByUsers;
    use CanBeRejectedByUsers;

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

    public static function getDataColumn(): string
    {
        return 'virtual_data_column';
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'business_group_id',
            'reference',
            'test_booking_id',
            'customer_email',
            'customer_phone_number',
            'approved_at',
            'approved_by',
            'rejected_at',
            'rejected_by',
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
