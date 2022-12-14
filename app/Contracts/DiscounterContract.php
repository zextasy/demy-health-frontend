<?php

namespace App\Contracts;

use App\Models\Finance\Discount;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface DiscounterContract
{
    public function discounts(): MorphToMany;

    public function getApplicableDiscounts(): Collection;

    public function canApplyDiscount(?Discount $discount): bool;
}
