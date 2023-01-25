<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Cost;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

trait MorphsCosts
{
    public function initializeMorphsCosts()
    {
        $this->append(['cost','formatted_cost']);
    }
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

    public function setCost(float $amount, Carbon $startDate = null, Carbon $endDate = null): Cost
    {
        $cost = $this->costs()->create([
            'amount' => $amount,
            'start_date' => $startDate ?? now(),
            'end_date' => $endDate ?? null,
        ]);

        return $cost;
    }
    protected function cost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getCost(),
        );
    }
    protected function formattedCost(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFormattedCost(),
        );
    }
    public function getCost(): float|null
    {
        $this->loadMissing('currentCost');
        return optional($this->currentCost)->amount;
    }

    public function getFormattedCost(): string
    {
        if ($this->should_call_in_for_details || empty($this->cost)) {
            return 'Call In';
        }

        return number_format($this->cost);
    }
}
