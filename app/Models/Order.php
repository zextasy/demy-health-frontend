<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use App\Filament\Resources\OrderResource;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\ReferencesUsersViaEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel
{
    use HasFactory, GeneratesReference, ReferencesUsersViaEmail, BelongsToBusinessGroup;

    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->order_prefix,
        ];
    }
    protected $with = ['items'];
    protected $appends = ['total_amount'];
    //endregion

    //region ATTRIBUTES
    public function getFilamentUrlAttribute(): string
    {
        return OrderResource::getUrl('view', ['record' => $this->id]);
    }

    public function getTotalAmountAttribute(): float
    {
        return $this->items->sum('total_amount');
    }
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
