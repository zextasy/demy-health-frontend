<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends BaseModel
{
    use HasFactory, GeneratesReference, BelongsToBusinessGroup;

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
