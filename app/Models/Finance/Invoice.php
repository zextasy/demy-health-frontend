<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\EncryptsId;
use App\Contracts\PayableContract;
use App\Enums\Orders\OrderStatusEnum;
use App\Traits\Models\HasFilamentUrl;
use App\Traits\Models\GeneratesReference;
use App\Traits\Models\SumsTotalAmountFromItems;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\Finance\Invoices\InvoiceStatusEnum;
use App\Filament\Resources\Finance\InvoiceResource;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Traits\Relationships\MorphsTransactionsAsCredit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends BaseModel  implements PayableContract
{
    use HasFactory;
    use GeneratesReference;
    use BelongsToBusinessGroup;
    use MorphsTransactionsAsCredit;
    use EncryptsId;
    use SumsTotalAmountFromItems;
    use HasRelationships;
    use HasFilamentUrl;

    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->invoice_prefix,
        ];
    }

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $with = ['items','transactions'];

    protected $appends = ['sub_total_amount','total_discount_amount','total_amount','outstanding_amount','status'];
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
            get: fn ($value) => $this->total_amount - $this->total_paid,
        );
    }

    public function totalPaid(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->transactions->sum('amount'),
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
    public function getFilamentUrl(): string
    {
        return $this->filament_url;
    }
    //endregion

    //region SCOPES

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

        return $status;
    }

    //endregion

}
