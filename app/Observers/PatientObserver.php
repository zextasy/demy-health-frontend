<?php

namespace App\Observers;

use App\Models\Patient;
use App\Helpers\ModelHelper;
use App\Settings\GeneralSettings;

class PatientObserver
{
    public function creating (Patient $model)
    {
        if (empty($model->age_classification) && isset($model->date_of_birth)){
            $model->age_classification = $model->resolveAgeClassification($model->date_of_birth);
        }
    }

    public function created(Patient $model)
    {
        //
    }

    public function updated(Patient $model)
    {
        //
    }

    public function deleted(Patient $model)
    {
        //
    }

    public function restored(Patient $model)
    {
        //
    }

    public function forceDeleted(Patient $model)
    {
        //
    }
}
