<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel
{
    use HasFactory, GeneratesReference;

    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->order_prefix,
        ];
    }
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
        return $this->hasMany(OrderItem::class);
    }

    public function orderable()
    {
        return $this->morphTo('orderable');
    }
    //endregion


}
