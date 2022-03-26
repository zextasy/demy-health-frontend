<?php

namespace App\Observers;

use App\Models\TestBooking;

class TestBookingObserver
{
    public function creating (TestBooking $testBooking)
    {
        $padding = str_pad($testBooking->id, 9, "0", STR_PAD_LEFT);
        $timeStamp = floor(time()-999999999);
        $testBooking->reference = 'DM-TB-'.$timeStamp;
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