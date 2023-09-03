<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use App\Contracts\AssignableContract;
use App\Traits\Models\HasFilamentUrl;
use App\Contracts\AddressableContract;
use App\Traits\Models\LaravelMorphable;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\OrderableItemContract;
use App\Traits\Relationships\Assignable;
use App\Traits\Models\GeneratesReference;
use App\Contracts\InvoiceableItemContract;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Traits\Relationships\HasTestResults;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\MorphsOrderItems;
use App\Filament\Resources\TestBookingResource;
use App\Traits\Relationships\MorphsInvoiceItems;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Models\SamplesAreProcessedByUsers;
use App\Traits\Models\PaymentsAreReceivedByUsers;
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
    use SamplesAreProcessedByUsers;
    use PaymentsAreReceivedByUsers;
    use HasTestResults;

    //region CONFIG
    protected $dates = ['created_at', 'updated_at', 'due_date'];

    protected $guarded = ['id'];

    protected $casts = [
        'location_type' => LocationTypeEnum::class,
        'status' => TestBookingStatusEnum::class
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

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->testType->price,
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

    public function getAssignableName(): string
    {
        return 'Test Booking - '.$this->name;
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

    public function getInvoiceableItemName(): string
    {
        return $this->getAssignableName();
    }

    public function getInvoiceableItemPrice(): float
    {
        return $this->price ?? 0;
    }

    public function getOrderableItemName(): string
    {
        return $this->getInvoiceableItemName();
    }

    public function getOrderableItemPrice(): float
    {
        return $this->getInvoiceableItemPrice();
    }

    public function getOrderableItemModel() : Model
    {
        return $this;
    }

    public function hasTestResultTemplate(): bool
    {
        return $this->testType->hasTestResultTemplate();
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

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }


    //endregion

    //region PRIVATE
    private function determineStatus(): TestBookingStatusEnum
    {
        $status = TestBookingStatusEnum::BOOKED;

        if ($this->orderHasBeenPlaced()) {
            $status = TestBookingStatusEnum::ORDER_PLACED;
        }

        if ($this->hasBeenInvoiced()) {
            $status = TestBookingStatusEnum::INVOICE_GENERATED;
        }

        if ($this->resultHasBeenGenerated()) {
            $status = TestBookingStatusEnum::RESULT_GENERATED;
        }

        return $status;
    }
    //endregion
}
