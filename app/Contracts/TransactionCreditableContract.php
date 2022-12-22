<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface TransactionCreditableContract
{
    public function transactions(): MorphMany;

    public function getMaximumCreditableAmount(): float;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}
