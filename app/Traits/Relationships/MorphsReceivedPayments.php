<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsReceivedPayments
{
    public function paymentsReceived(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
