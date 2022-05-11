<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Traits\Relationships\HasAddresses;
use App\Enums\TestBooking\LocationTypeEnum;
use App\Filament\Resources\TestBookingResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestBooking extends BaseModel
{
    use HasFactory, HasAddresses;

    //region CONFIG
    protected $dates = ['created_at', 'updated_at','due_date'];
    protected $guarded = ['id'];

    protected $casts = [
        'location_type' => LocationTypeEnum::class,
    ];
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'customer_email','email');
    }

    public function testCenter(): BelongsTo
    {
        return $this->belongsTo(TestCenter::class);
    }

    //    public function specimenSample() :hasMany
    //    {
    //        return $this->hasMany();
    //    }

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
