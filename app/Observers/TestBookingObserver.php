<?php

namespace App\Observers;

use App\Models\TestBooking;
use App\Helpers\ModelHelper;
use App\Settings\GeneralSettings;

class TestBookingObserver
{
    public function creating (TestBooking $model)
    {
        if (empty($model->reference)){
            $nextId = (new ModelHelper)->getNextId('test_bookings');
            $padding = str_pad($nextId, 9, "0", STR_PAD_LEFT);
            $model->reference = app(GeneralSettings::class)->test_booking_prefix.$padding;
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
