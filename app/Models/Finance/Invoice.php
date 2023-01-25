<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\EncryptsId;
use Illuminate\Support\Collection;
use App\Traits\Models\HasFilamentUrl;
use App\Traits\Models\LaravelMorphable;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\Discountable;
use App\Traits\Relationships\MorphsToCustomer;
use App\Contracts\TransactionCreditableContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\Finance\Invoices\InvoiceStatusEnum;
use App\Traits\Models\SumsSubTotalAmountFromItems;
use App\Filament\Resources\Finance\InvoiceResource;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Traits\Relationships\MorphsTransactionsAsCredit;
use App\Traits\Relationships\BelongsToActiveCustomerViaCustomerEmail;

class Invoice extends BaseModel  implements TransactionCreditableContract
{
    use HasFactory;
    use GeneratesReference;
    use BelongsToBusinessGroup;
    use MorphsTransactionsAsCredit;
    use EncryptsId;
    use SumsSubTotalAmountFromItems;
    use Discountable;
    use HasRelationships;
    use HasFilamentUrl;
    use LaravelMorphable;
    use MorphsToCustomer;
    use BelongsToActiveCustomerViaCustomerEmail;

    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->invoice_prefix,
        ];
    }

    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'sent_at',
        'payment_received_at',
        'payment_refunded_at',
        'credit_approved_at',
        'cancelled_at',
    ];

    protected $with = ['items','transactions'];

    protected $appends = [
        'sub_total_amount',
        'total_discount_amount',
        'total_amount',
        'outstanding_amount',
        'status'
    ];
    //endregion

    //region ATTRIBUTES

    public function payableName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->reference,
        );
    }

    public function outstandingAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getMaximumCreditableAmount(),
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
        return InvoiceResource::class;
    }

    public function getMaximumCreditableAmount(): float
    {
        $value = $this->total_amount - $this->total_transaction_amount;

        return max($value, 0);
    }

    public function getEmailForPayment(): ?string
    {
        return $this->customer_email;
    }

    protected function getTotalAmount(): float
    {
        return max(($this->sub_total_amount - $this->total_discount_amount), 0);
    }

    public function hasBeenSettled() : bool
    {
        return !empty($this->payment_received_at);
    }

    public function hasNotBeenSettled() : bool
    {
        return !$this->hasBeenSettled();
    }

    public function updatePaymentStatus(): void
    {
        if ($this->outstanding_amount < 1 && empty($this->payment_received_at)) {
            $this->update(['payment_received_at' => now()]);
        }
    }

    public function getPayableReference(): string
    {
        return $this->reference;
    }

    public function getApplicablePayments(): ?Collection
    {
        return Payment::query()->whereCustomerEmail($this->customer_email)->hasNotBeenSettled()->get();
    }
    //endregion

    //region SCOPES
    public function scopeHasBeenSettled($query)
    {
        return $query->whereNotNull('payment_received_at');
    }

    public function scopeHasNotBeenSettled($query)
    {
        return $query->whereNull('payment_received_at');
    }
    public function scopeNeedsProcessing($query)
    {
        return $query->hasNotBeenSettled();
    }
    //endregion

    //region RELATIONSHIPS
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoiceable(): MorphTo
    {
        return $this->morphTo('invoiceable');
    }

    public function discounts(): MorphToMany
    {
        return $this->invoiceable->discounts();
    }
    //endregion

    //region PRIVATE
    private function getTotalDiscountAmount(): float
    {
        $this->loadMissing('invoiceable');
        if (empty($this->invoiceable)) {
            return 0;
        }
        return $this->invoiceable->getTotalDiscountAmount();
    }

    private function determineStatus(): string
    {
        $status = InvoiceStatusEnum::GENERATED->value;

        if ($this->transactions()->exists()) {
            $status = InvoiceStatusEnum::PAYMENT_RECEIVED->value;
        }

        if ($this->outstanding_amount < 1) {
            $status = InvoiceStatusEnum::SETTLED->value;
        }

        return $status;
    }

    //endregion
}
