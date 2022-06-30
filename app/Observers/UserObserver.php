<?php

namespace App\Observers;


use App\Models\User;

class UserObserver
{
    public function creating(User $model)
    {
    }

    public function created(User $model)
    {
        if (!$model->hasAnyRole(['admin', 'manager', 'editor'])){
            $model->assignRole('customer');
        }
    }

    public function updated(User $model)
    {
        //
    }

    public function deleted(User $model)
    {
        //
    }

    public function restored(User $model)
    {
        //
    }

    public function forceDeleted(User $model)
    {
        //
    }
}
