<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsPayments
{

    public function payments(): MorphMany
    {
        return $this->MorphMany(Payment::class, 'payable');
    }
}
