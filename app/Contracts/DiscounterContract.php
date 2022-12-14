<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface DiscounterContract
{
    public function discounts(): MorphToMany;

    public function getApplicableDiscounts(): Collection;
}
