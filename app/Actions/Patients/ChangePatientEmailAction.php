<?php

namespace App\Actions\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Actions\TestResults\ChangeTestResultEmailAction;
use App\Actions\TestBookings\ChangeTestBookingEmailAction;

class ChangePatientEmailAction
{

    public function run(Patient|int $patient, string $email): Patient
    {
        $patient = $patient instanceof Patient ? $patient : Patient::findOrFail($patient);
        ray($patient, $email);
        DB::transaction(function () use ($email, $patient) {
            $patient->update(['email' => $email]);
            $patient->loadMissing(['testBookings','testResults']);
            $testBookingAction = new ChangeTestBookingEmailAction;
            $testResultAction = new ChangeTestResultEmailAction;
            foreach ($patient->testBookings as $testBooking) {
                $testBookingAction->run($testBooking, $email);
            }
            foreach ($patient->testResults as $testResult) {
                $testResultAction->run($testResult, $email);
            }
        });
        ray($patient);
        return $patient;
    }
}
