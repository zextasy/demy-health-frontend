<?php

namespace App\Observers;

use App\Models\TestBooking;

class TestBookingObserver
{
    public function creating(TestBooking $model)
    {
        if (empty($model->customer_email)) {
            $model->customer_email = $model->patient->email;
        }
        if (empty($model->customer_phone_number)) {
            $model->customer_phone_number = $model->patient->phone_number;
        }
    }

    public function created(TestBooking $model)
    {
        //
    }

    public function updated(TestBooking $model)
    {
        //
    }

    public function deleted(TestBooking $model)
    {
        //
    }

    public function restored(TestBooking $model)
    {
        //
    }

    public function forceDeleted(TestBooking $model)
    {
        //
    }
}
