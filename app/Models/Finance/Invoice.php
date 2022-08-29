<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Contracts\PayableContract;
use App\Traits\Models\GeneratesReference;
use App\Filament\Resources\Finance\InvoiceResource;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\MorphsReceivedPayments;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends BaseModel  implements PayableContract
{
    use HasFactory, GeneratesReference, BelongsToBusinessGroup, MorphsReceivedPayments;

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
    //endregion

    //region ATTRIBUTES
    public function getFilamentUrlAttribute(): string
    {
        return InvoiceResource::getUrl('view', ['record' => $this->id]);
    }

    public function getTotalAmountAttribute(): float
    {
        return $this->items->sum('total_amount');
    }

    public function getPayableNameAttribute(): string
    {
        return $this->reference;
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
