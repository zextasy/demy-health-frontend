<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Traits\Models\CalculatesTotalAmount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends BaseModel
{
    use HasFactory;
    use CalculatesTotalAmount;

    //region CONFIG
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];
    protected $appends = ['total_amount'];
//    protected $with = ['invoice'];

    protected $casts = ['price' => 'float'];
    //endregion

    //region ATTRIBUTES

    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS

    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function invoiceableItem()
    {
        return $this->morphTo('invoiceable_item');
    }
    //endregion
}
