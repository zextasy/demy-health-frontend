<?php

namespace App\Actions\Visits;

use App\Models\Visit;
use App\Models\Patient;
use App\Models\BaseModel;
use Illuminate\Support\Facades\DB;
use App\Contracts\VisitableLocationContract;


class CreateVisitAction
{

    public ?string $reference = null;

    public function run(Patient $visitor, VisitableLocationContract $location): ?Visit
    {

        $visit = new Visit;
        $visit->reference = $this->reference;
        $visit->patient_id = $visitor->id;
        $visit->visitable_location_id = $location->getLaravelMorphModelId();
        $visit->visitable_location_type = $location->getLaravelMorphModelType();
        DB::transaction(function () use ($visit) {
            $visit->save();
        });

        return $visit;
    }

    public function withReference(?string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }
}
