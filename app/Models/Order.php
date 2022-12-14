<?php

namespace App\Models;

use App\Models\Finance\Discount;
use App\Traits\Models\EncryptsId;
use App\Settings\GeneralSettings;
use App\Contracts\InvoiceableContract;
use App\Traits\Models\LaravelMorphable;
use App\Contracts\DiscountableContract;
use App\Filament\Resources\OrderResource;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\Discountable;
use App\Traits\Relationships\MorphsInvoice;
use App\Traits\Models\SumsTotalAmountFromItems;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\ReferencesUsersViaEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends BaseModel implements InvoiceableContract, DiscountableContract
{
    use HasFactory;
    use GeneratesReference;
    use ReferencesUsersViaEmail;
    use BelongsToBusinessGroup;
    use SumsTotalAmountFromItems;
    use EncryptsId;
    use MorphsInvoice;
    use LaravelMorphable;
    use Discountable;

    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->order_prefix,
        ];
    }

    protected $with = ['items','discounts','customer'];

    protected $appends = ['total_amount'];

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'payment_method' => PaymentMethodEnum::class,
    ];
    //endregion

    //region ATTRIBUTES
    public function getFilamentUrlAttribute(): string
    {
        return OrderResource::getUrl('view', ['record' => $this->id]);
    }

    public function getPayableNameAttribute(): string
    {
        return $this->reference;
    }
    //endregion

    //region HELPERS
    public function hasBeenInvoiced(): bool
    {
        return  $this->invoice()->exists();
    }

    public function hasNotBeenInvoiced(): bool
    {
        return  !$this->hasBeenInvoiced();
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->morphTo('customer');
    }
    //endregion
}
