<?php

namespace App\Traits\Relationships;

use App\Models\Order;
use App\Models\Finance\Cost;
use App\Models\Finance\Price;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsCosts
{

    public function costs(): MorphMany
    {
        return $this->MorphMany(Cost::class, 'costable');
    }

    public function costHistory(): MorphMany
    {
        return $this->costs()->orderBy('start_date');
    }

    public function currentCost(): Cost|null
    {
        return $this->costs()->isActive()->first();
    }

    public function setCost(float $amount, Carbon $startDate = null, Carbon $endDate = null): Price
    {
        $cost = $this->costs()->create([
            'amount' => $amount,
            'start_date' => $startDate ?? now(),
            'end_date' => $endDate ?? null,
        ]);

        return $cost;
    }

    public function getCostAttribute():float|null
    {
        return optional($this->currentCost)->amount;
    }
}
