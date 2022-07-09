<?php

namespace App\Observers;


use App\Models\Finance\Price;

class PriceObserver
{
    public function creating(Price $model)
    {
        if (empty($model->start_date)) {
            $model->start_date = now();
        }
    }

    public function created(Price $model)
    {
        $model->priceable->prices()->isActive()->whereNotIn('id', [$model->id])->update(['end_date' => $model->start_date]);
    }

    public function updated(Price $model)
    {
        //
    }

    public function deleted(Price $model)
    {
        //
    }

    public function restored(Price $model)
    {
        //
    }

    public function forceDeleted(Price $model)
    {
        //
    }
}
