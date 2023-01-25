<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface TransactionCreditableContract
{
    public function transactions(): MorphMany;

    public function getMaximumCreditableAmount(): float;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;

    public function updatePaymentStatus(): void;

    public function getPayableReference(): string;

    public function getEmailForPayment(): ?string;
    
    public function getApplicablePayments(): ?Collection;
}
