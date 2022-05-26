<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends BaseModel
{
    use HasFactory;

    //region CONFIG

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
