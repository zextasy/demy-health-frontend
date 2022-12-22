<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Transaction;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsTransactionsAsDebit
{
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'debitable');
    }

    protected function totalTransactionAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->transactions()->sum('amount'),
        );
    }
}
