<?php

namespace App\Observers;

use App\Models\TestResult;
use App\Events\NewTestResultAddedEvent;

class TestResultObserver
{
    public function creating(TestResult $model)
    {
        if (is_null($model->customer_email)) {
            $model->customer_email = $model->testBooking->customer_email;
        }
        if (is_null($model->customer_phone_number)) {
            $model->customer_phone_number = $model->testBooking->customer_phone_number;
        }
    }

    public function created(TestResult $model)
    {
        NewTestResultAddedEvent::dispatch($model);
    }

    public function updated(TestResult $model)
    {
        //
    }

    public function deleted(TestResult $model)
    {
        //
    }

    public function restored(TestResult $model)
    {
        //
    }

    public function forceDeleted(TestResult $model)
    {
        //
    }
}
