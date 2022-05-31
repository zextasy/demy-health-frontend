<?php

namespace App\Observers;

use App\Models\Product;
use App\Helpers\ModelHelper;
use App\Settings\GeneralSettings;

class ProductObserver
{
    public function creating (Product $model)
    {
        $nextId = (new ModelHelper)->getNextId('products');
        $padding = str_pad($nextId, 9, "0", STR_PAD_LEFT);
        $model->sku = app(GeneralSettings::class)->product_sku_prefix.$padding;
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
