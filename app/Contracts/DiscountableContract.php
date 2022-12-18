<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface DiscountableContract
{
    public function discounts(): MorphToMany;
    public function getLaravelMorphModelType(): string;
    public function getLaravelMorphModelId(): int;
}
