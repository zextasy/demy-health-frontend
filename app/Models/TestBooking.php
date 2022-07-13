<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Settings\GeneralSettings;
use App\Contracts\AddressableContract;
use App\Contracts\OrderableItemContract;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\MorphsAddresses;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Traits\Relationships\MorphsOrderItems;
use App\Filament\Resources\TestBookingResource;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Relationships\ReferencesUsersViaEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestBooking extends BaseModel implements OrderableItemContract, AddressableContract
{
    use HasFactory, MorphsAddresses, MorphsOrderItems, GeneratesReference, ReferencesUsersViaEmail, BelongsToBusinessGroup;

    //region CONFIG
    protected $dates = ['created_at', 'updated_at','due_date'];
    protected $guarded = ['id'];

    protected $casts = [
        'location_type' => LocationTypeEnum::class,
    ];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->test_booking_prefix,
        ];
    }
    //endregion

    //region ATTRIBUTES
    public function getFilamentUrlAttribute(): string
    {
        return TestBookingResource::getUrl('view', ['record' => $this->id]);
    }
    //endregion

    //region HELPERS
    public function toFullCalenderEventArray(): array
    {
        return [
            'id' => $this->id,
            'title' => "{$this->testType->description} for {$this->customer_email}",
            'start' => $this->due_date,
            'url' => $this->filament_url,
        ];
    }

    public function paymentHasBeenReceived(): bool
    {
        return $this->payment_received_at !== null;
    }

    public function sampleCollectionHasBeenApproved(): bool
    {
        return $this->sample_collection_approved_at !== null;
    }

    public function sampleHasBeenReceived(): bool
    {
        return $this->sample_received_at !== null;
    }

    public function processingHasBeenInitiated(): bool
    {
        return $this->processing_initiated_at !== null;
    }

    public function processingIsComplete(): bool
    {
        return $this->processing_completed_at !== null;
    }

    public function resultHasBeenApproved(): bool
    {
        return $this->result_approved_at !== null;
    }

    public function sampleWasRejected(): bool
    {
        return $this->sample_rejected_at !== null;
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS`
    public function testType(): BelongsTo
    {
        return $this->belongsTo(TestType::class);
    }

    public function testCenter(): BelongsTo
    {
        return $this->belongsTo(TestCenter::class);
    }

    public function testResult(): HasOne
    {
        return $this->hasOne(TestResult::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function paymentRecordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_recorded_by');
    }

    public function sampleCollectionApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sample_collection_approved_by');
    }

    public function sampleReceivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sample_received_by');
    }

    public function resultApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'result_approved_by');
    }

    public function sampleRejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sample_rejected_by');
    }
    //endregion
}
