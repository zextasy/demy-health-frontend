<?php

namespace App\Models;

use App\Models\Base\Item;
use App\Traits\Models\CalculatesTotalAmount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Item
{
    use HasFactory;
    use CalculatesTotalAmount;

    //region CONFIG
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = ['total_amount'];

    protected $casts = ['price' => 'float'];

//    protected $with = ['orderableItem'];
    //endregion

    //region ATTRIBUTES

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
