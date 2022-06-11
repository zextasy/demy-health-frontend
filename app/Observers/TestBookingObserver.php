<?php

namespace App\Observers;

use App\Models\TestBooking;
use App\Helpers\ModelHelper;
use App\Settings\GeneralSettings;

class TestBookingObserver
{
    public function creating (TestBooking $model)
    {

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
