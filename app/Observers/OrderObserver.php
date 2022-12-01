<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;

class OrderObserver
{
    public function creating(Order $model)
    {
        if (empty($model->customer_type)) {
            $customer = User::where('email', $model->customer_email)->first();
            $model->customer_id = $customer?->getLaravelMorphModelId();
            $model->customer_type = $customer?->getLaravelMorphModelType();
        }
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
