<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\EncryptsId;
use App\Contracts\PayableContract;
use App\Traits\Models\GeneratesReference;
use App\Traits\Models\SumsTotalAmountFromItems;
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

    protected $appends = ['sub_total_amount','total_discount_amount','total_amount','outstanding_amount'];
    //endregion

    //region ATTRIBUTES
    public function getFilamentUrlAttribute(): string
    {
        return InvoiceResource::getUrl('view', ['record' => $this->id]);
    }

    public function getPayableNameAttribute(): string
    {
        return $this->reference;
    }

    public function getOutstandingAmountAttribute(): float
    {
        return $this->total_amount - $this->total_paid;
    }

    public function getTotalPaidAttribute(): float
    {
        return $this->transactions->sum('amount');
    }
    //endregion

    //region HELPERS

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
    private function getTotalDiscountAmount(): float
    {
        if (empty($this->invoiceable)) {
            return 0;
        }
        return $this->invoiceable->getTotalDiscountAmount();
    }
}
