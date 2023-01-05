<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface TransactionDebitableContract
{
    public function transactions(): MorphMany;

    public function getMaximumDebitableAmount(): float;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;

    public function updatePaymentStatus(): void;

    public function getCreditorName(): string;
}
