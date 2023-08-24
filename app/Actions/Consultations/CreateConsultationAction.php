<?php

namespace App\Actions\Consultations;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Consultation;

class CreateConsultationAction
{

    public function run(int| User $consultant, Carbon $dueAt): Consultation
    {
        $consultantId = $consultant instanceof User ? $consultant->id : $consultant;
        $consultation = new Consultation();
        $consultation->consultant_id = $consultantId;
        $consultation->due_at = $dueAt;
        $consultation->save();

        $this->raiseEvents($consultation);
        return $consultation;
    }

    private function raiseEvents(Consultation $consultation)
    {

    }
}
