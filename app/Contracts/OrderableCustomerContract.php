<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface OrderableCustomerContract
{//TODO consider merging this and Invoicable into a single customer contract
    public function orders(): MorphMany;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}
