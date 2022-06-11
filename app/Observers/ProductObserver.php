<?php

namespace App\Observers;

use App\Models\Product;
use App\Helpers\ModelHelper;
use App\Settings\GeneralSettings;

class ProductObserver
{
    public function creating (Product $model)
    {
    }

    public function created(Product $model)
    {
        //
    }

    public function updated(Product $model)
    {
        //
    }

    public function deleted(Product $model)
    {
        //
    }

    public function restored(Product $model)
    {
        //
    }

    public function forceDeleted(Product $model)
    {
        //
    }
}
