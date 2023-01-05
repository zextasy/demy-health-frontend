<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use App\Contracts\AssignableContract;
use App\Traits\Models\HasFilamentUrl;
use App\Contracts\AddressableContract;
use App\Traits\Models\LaravelMorphable;
use App\Contracts\OrderableItemContract;
use App\Traits\Relationships\Assignable;
use App\Traits\Models\GeneratesReference;
use App\Contracts\InvoiceableItemContract;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\MorphsOrderItems;
use App\Filament\Resources\TestBookingResource;
use App\Traits\Relationships\MorphsInvoiceItems;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\Finance\TestBookings\TestBookingStatusEnum;
use App\Traits\Relationships\BelongsToActiveCustomerViaCustomerEmail;

class TestBooking extends BaseModel implements
    OrderableItemContract,
    InvoiceableItemContract,
    AddressableContract,
    AssignableContract
{
    use HasFactory;
    use MorphsAddresses;
    use MorphsOrderItems;
    use MorphsInvoiceItems;
    use LaravelMorphable;
    use GeneratesReference;
    use BelongsToActiveCustomerViaCustomerEmail;
    use BelongsToBusinessGroup;
    use Assignable;
    use HasFilamentUrl;

    //region CONFIG
    protected $dates = ['created_at', 'updated_at', 'due_date'];

    protected $guarded = ['id'];

    protected $casts = [
        'location_type' => LocationTypeEnum::class,
    ];

    protected $with = ['testType','orderItems','InvoiceItems'];

    protected $appends = ['status'];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->test_booking_prefix,
        ];
    }
    //endregion

    //region ATTRIBUTES


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->testType->name,
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->determineStatus(),
        );
    }
    //endregion

    //region HELPERS
    public function getFilamentResourceClass(): string
    {
        return TestBookingResource::class;
    }
    public function getFilamentUrl(): string
    {
        return $this->filament_url;
    }

    public function getAssignableName(): string
    {
        return $this->name;
    }
    public function toFullCalenderEventArray(): array
    {
        //TODO fix issue with nullable testType
        return [
            'id' => $this->id,
            'title' => "{$this->testType?->name} for {$this->customer_email}",
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

    public function resultHasBeenGenerated(): bool
    {
        return $this->testResults()->exists();
    }

    public function resultHasNotBeenGenerated(): bool
    {
        return !$this->resultHasBeenGenerated();
    }

    public function resultHasBeenApproved(): bool
    {
        return $this->result_approved_at !== null;
    }

    public function sampleWasRejected(): bool
    {
        return $this->sample_rejected_at !== null;
    }

    public function testResultIsComplete():bool
    {
        return false;
    }

    public function testResultIsNotComplete():bool
    {
        return !$this->testResultIsComplete();
    }

    public function getInvoiceableItemName(): string
    {
        return $this->getAssignableName();
    }

    public function getInvoiceableItemPrice(): float
    {
        return $this->price;
    }

    public function getOrderableItemName(): string
    {
        return $this->getInvoiceableItemName();
    }

    public function getOrderableItemPrice(): float
    {
        return $this->getInvoiceableItemPrice();
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

    public function testResults(): HasMany
    {
        return $this->hasMany(TestResult::class);
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

    //region PRIVATE
    private function determineStatus(): string
    {
        $status = TestBookingStatusEnum::BOOKED->value;

        if ($this->orderHasBeenPlaced()) {
            $status = TestBookingStatusEnum::ORDER_PLACED->value;
        }

        if ($this->hasBeenInvoiced()) {
            $status = TestBookingStatusEnum::INVOICE_GENERATED->value;
        }

        if ($this->resultHasBeenGenerated()) {
            $status = TestBookingStatusEnum::RESULT_GENERATED->value;
        }

        return $status;
    }
    //endregion
}
