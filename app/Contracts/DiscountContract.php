<?php

namespace App\Contracts;

interface DiscountContract
{
    public function getDiscountAmount(int|float $total): float;

    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;

    public function setDiscountValue(int|float $value): void;
}
