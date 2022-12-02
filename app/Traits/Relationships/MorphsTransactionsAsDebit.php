<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsTransactionsAsDebit
{
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'debitable');
    }
}
