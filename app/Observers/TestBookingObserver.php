<?php

namespace App\Observers;

use App\Models\TestBooking;
use App\Helpers\ModelHelper;
use App\Settings\GeneralSettings;

class TestBookingObserver
{
    public function creating (TestBooking $testBooking)
    {

        $nextId = (new ModelHelper)->getNextId('test_bookings');
        $padding = str_pad($nextId, 9, "0", STR_PAD_LEFT);
        $testBooking->reference = app(GeneralSettings::class)->test_booking_prefix.$padding;
    }

    public function created(TestBooking $testBooking)
    {
        //
    }

    /**
     * Handle the TestBooking "updated" event.
     *
     * @param  \App\Models\TestBooking  $testBooking
     * @return void
     */
    public function updated(TestBooking $testBooking)
    {
        //
    }

    /**
     * Handle the TestBooking "deleted" event.
     *
     * @param  \App\Models\TestBooking  $testBooking
     * @return void
     */
    public function deleted(TestBooking $testBooking)
    {
        //
    }

    /**
     * Handle the TestBooking "restored" event.
     *
     * @param  \App\Models\TestBooking  $testBooking
     * @return void
     */
    public function restored(TestBooking $testBooking)
    {
        //
    }

    /**
     * Handle the TestBooking "force deleted" event.
     *
     * @param  \App\Models\TestBooking  $testBooking
     * @return void
     */
    public function forceDeleted(TestBooking $testBooking)
    {
        //
    }
}
