<?php

namespace App\Models;

use App\Traits\Models\EncryptsId;
use App\Settings\GeneralSettings;
use App\Enums\Orders\OrderStatusEnum;
use App\Traits\Models\HasFilamentUrl;
use App\Contracts\InvoiceableContract;
use App\Traits\Models\LaravelMorphable;
use App\Contracts\DiscountableContract;
use App\Traits\Models\GeneratesReference;
use App\Filament\Resources\OrderResource;
use App\Traits\Relationships\Discountable;
use App\Traits\Relationships\MorphsInvoice;
use App\Traits\Relationships\MorphsToCustomer;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\Models\SumsSubTotalAmountFromItems;
use App\Filament\Resources\Finance\InvoiceResource;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Relationships\BelongsToActiveCustomerViaCustomerEmail;

class Order extends BaseModel implements InvoiceableContract, DiscountableContract
{
    use HasFactory;
    use GeneratesReference;
    use BelongsToBusinessGroup;
    use SumsSubTotalAmountFromItems;
    use EncryptsId;
    use MorphsInvoice;
    use LaravelMorphable;
    use Discountable;
    use HasFilamentUrl;
    use MorphsToCustomer;
    use BelongsToActiveCustomerViaCustomerEmail;

    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->order_prefix,
        ];
    }

    protected $with = ['items','discounts','customer'];

    protected $appends = ['sub_total_amount','total_discount_amount','total_amount','status'];

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
    ];
    //endregion

    //region ATTRIBUTES

    public function payableName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->reference,
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
        return OrderResource::class;
    }
    public function hasBeenInvoiced(): bool
    {
        return  $this->invoice()->exists();
    }

    public function hasNotBeenInvoiced(): bool
    {
        return  !$this->hasBeenInvoiced();
    }

    public function getTotalDiscountAmount(): float
    {
        $totalDiscountAmount = 0;

        foreach ($this->discounts as $discount) {
            $totalDiscountAmount += $discount->getDiscountAmount($this->sub_total_amount);
        }

        return $totalDiscountAmount;
    }

    protected function getTotalAmount(): float
    {
        return max(($this->sub_total_amount - $this->total_discount_amount), 0);
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    //endregion

    //region PRIVATE
    private function determineStatus(): string
    {
        $status = OrderStatusEnum::PLACED->value;

        if ($this->invoice()->exists()) {
            $status = OrderStatusEnum::INVOICE_GENERATED->value;
        }

        return $status;
    }
    //endregion
}
