<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface DiscounterContract
{
    public function discounts(): MorphToMany;
}
