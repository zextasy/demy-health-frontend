<?php

namespace App\Contracts;

interface PayerContract
{
    public function getLaravelMorphModelType(): string;

    public function getLaravelMorphModelId(): int;
}
