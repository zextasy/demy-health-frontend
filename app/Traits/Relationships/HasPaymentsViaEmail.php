<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Payment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPaymentsViaEmail
{
    public function payments(): HasMany
    {
        return $this->HasMany(Payment::class, 'customer_email', 'email');
    }
}
