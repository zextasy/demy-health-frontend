<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\EncryptsId;
use App\Contracts\PayableContract;
use App\Traits\Models\GeneratesReference;
use App\Traits\Models\SumsTotalAmountFromItems;
use App\Filament\Resources\Finance\InvoiceResource;
use App\Traits\Relationships\BelongsToBusinessGroup;
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

    protected $appends = ['total_amount','outstanding_amount'];
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
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoiceable()
    {
        return $this->morphTo('invoiceable');
    }

    //endregion
}
