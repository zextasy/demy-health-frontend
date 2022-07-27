<?php

namespace App\Traits\Relationships;

use App\Models\BusinessGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToBusinessGroup
{
    public static function bootBelongsToBusinessGroup()
    {
        static::creating(function (Model $model) {
            if (empty($model->business_group_id)) {
                $model->business_group_id = auth()->user()?->business_group_id ?? BusinessGroup::root()->id;
            }
        });
    }

    public function businessGroup(): BelongsTo
    {
        return $this->belongsTo(BusinessGroup::class);
    }
}
