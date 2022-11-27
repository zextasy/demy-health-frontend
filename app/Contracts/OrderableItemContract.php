<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface OrderableItemContract
{
    public function orderItems(): MorphMany;

    public function getOrderableItemName() : string;

    public function getOrderableItemPrice() : float;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}
