<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends BaseModel
{
    use HasFactory;

    //region CONFIG
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $appends = ['total_amount'];
    protected $casts = ['price' => 'float'];
    //endregion

    //region ATTRIBUTES
    public function getTotalAmountAttribute(): float
    {
        return $this->price * $this->quantity;
    }
    //endregion

    //region HELPERS

    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderableItem()
    {
        return $this->morphTo('orderable_item');
    }
    //endregion

}
