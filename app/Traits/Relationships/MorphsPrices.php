<?php

namespace App\Traits\Relationships;

use App\Models\Finance\Price;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

trait MorphsPrices
{
    public function prices(): MorphMany
    {
        return $this->MorphMany(Price::class, 'priceable');
    }

    public function priceHistory(): MorphMany
    {
        return $this->prices()->orderBy('start_date');
    }

    public function currentPrice(): MorphOne
    {
        return $this->MorphOne(Price::class, 'priceable')->isActive()->latestOfMany();
    }

    public function setPrice(float $amount, Carbon $startDate = null, Carbon $endDate = null): Price
    {
        return $this->prices()->create([
            'amount' => $amount,
            'start_date' => $startDate ?? now(),
            'end_date' => $endDate ?? null,
        ]);
    }

    public function getPriceAttribute(): float|null
    {
        $this->loadMissing('currentPrice');

        return optional($this->currentPrice)->amount;
    }

    public function getformattedPriceAttribute()
    {
        if ($this->should_call_in_for_details || empty($this->price)) {
            return 'Call In';
        }

        return number_format($this->price);
    }
}
