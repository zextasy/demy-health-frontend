<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsSentPayments
{
    public function paymentsMade(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payer');
    }
}
