<?php

namespace App\Traits\Relationships;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasOrdersViaEmail
{
    public function orders(): HasMany
    {
        return $this->HasMany(Order::class, 'customer_email', 'email');
    }
}
