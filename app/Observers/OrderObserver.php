<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    public function creating(Order $model)
    {
    }

    public function created(Order $model)
    {
        //
    }

    public function updated(Order $model)
    {
        //
    }

    public function deleted(Order $model)
    {
        //
    }

    public function restored(Order $model)
    {
        //
    }

    public function forceDeleted(Order $model)
    {
        //
    }
}
