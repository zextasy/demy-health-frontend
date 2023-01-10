<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaystackTransaction extends BaseModel
{
    use HasFactory;

//region CONFIG
    protected $fillable = ['reference', 'success', 'amount', 'status', 'channel', 'currency','customer', 'metadata'];

    protected $casts = [
        'customer' => 'array',
        'metadata' => 'array'
    ];
//endregion

//region ATTRIBUTES

//endregion

//region HELPERS
    public function hasPayment(): bool
    {
        return $this->payment()->exists();
    }

    public function doesntHavePayment(): bool
    {
        return !$this->hasPayment();
    }
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS
    public function payment():BelongsTo
    {
        return $this->belongsTo(Payment::class, 'reference', 'external_reference');
    }
//endregion

}
