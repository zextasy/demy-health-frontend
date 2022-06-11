<?php

namespace App\Observers;


use App\Helpers\ModelHelper;
use App\Models\Finance\Invoice;
use App\Settings\GeneralSettings;

class InvoiceObserver
{
    public function creating (Invoice $model)
    {
    }

    public function created(Invoice $model)
    {
        //
    }

    public function updated(Invoice $model)
    {
        //
    }

    public function deleted(Invoice $model)
    {
        //
    }

    public function restored(Invoice $model)
    {
        //
    }

    public function forceDeleted(Invoice $model)
    {
        //
    }
}
