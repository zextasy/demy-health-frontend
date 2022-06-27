<?php

namespace App\Traits\Relationships;

use App\Models\Order;
use App\Models\Finance\Price;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
        $price = $this->prices()->create([
            'amount' => $amount,
            'start_date' => $startDate ?? now(),
            'end_date' => $endDate ?? null,
        ]);

        return $price;
    }

    public function getPriceAttribute():float|null
    {
        $this->loadMissing('currentPrice');
        return optional($this->currentPrice)->amount;
    }

    public function getformattedPriceAttribute()
    {
        if ($this->should_call_in_for_details) {
            return "Call In";
        }

        return number_format($this->price);
    }
}
