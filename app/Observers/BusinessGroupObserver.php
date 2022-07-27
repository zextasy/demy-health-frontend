<?php

namespace App\Observers;

use App\Models\BusinessGroup;

class BusinessGroupObserver
{
    public function creating(BusinessGroup $model)
    {
        if (empty($model->parent_id)) {
            if (! empty(BusinessGroup::root())) {
                throw new \Exception('Root Business Group already exists');
            }
            $model->order = 0;

            return;
        }

        $model->order = BusinessGroup::findOrFail($model->parent_id)->order + 1;
    }

    public function created(BusinessGroup $model)
    {
        //
    }

    public function updated(BusinessGroup $model)
    {
        //
    }

    public function deleted(BusinessGroup $model)
    {
        //
    }

    public function restored(BusinessGroup $model)
    {
        //
    }

    public function forceDeleted(BusinessGroup $model)
    {
        //
    }
}
