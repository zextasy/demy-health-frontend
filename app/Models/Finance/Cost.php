<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Traits\Models\HasAmounts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cost extends BaseModel
{
    use HasFactory, HasAmounts;

    //region CONFIG
    protected $guarded = ['id'];

    protected $casts = ['amount' => 'float'];

    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];
    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS

    //endregion

    //region SCOPES
    public function scopeIsActive($query)
    {
        return $query->where(function ($subQuery) {
            $subQuery->where('end_date', '>', now())->orWhereNull('end_date');
        })->where('start_date', '<=', now()->endOfDay());
    }
    //endregion

    //region RELATIONSHIPS

    //endregion
}
