<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface InvoiceableContract
{
    public function invoice(): MorphOne;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;

    public function discounts(): MorphToMany;

    public function getTotalDiscountAmount(): float;
}
