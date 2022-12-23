<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Transaction;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsTransactionsAsCredit
{
    public function initializeMorphsTransactionsAsCreditTrait()
    {
        $this->append('total_transaction_amount');
    }


    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'creditable');
    }

    protected function totalTransactionAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->totalTransactionSum(),
        );
    }

    public function scopeHasTransactions($query)
    {
        return $query->has('transactions');
    }

    public function scopeDoesntHaveTransactions($query)
    {
        return $query->doesntHave('transactions');
    }

    abstract public function scopeHasBeenSettled($query);

    abstract public function scopeHasNotBeenSettled($query);

    abstract public function scopeNeedsProcessing($query);

    public function totalTransactionSum()
    {
        return $this->transactions()->sum('amount');
    }

}
