<?php

namespace App\Actions\Patients;

use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Actions\Payments\ChangePaymentEmailAction;
use App\Actions\TestResults\ChangeTestResultEmailAction;
use App\Actions\TestBookings\ChangeTestBookingEmailAction;

class ChangePatientEmailAction
{

    public function run(Patient|int $patient, string $email): Patient
    {
        $patient = $patient instanceof Patient ? $patient : Patient::findOrFail($patient);
        DB::transaction(function () use ($email, $patient) {
            $patient->loadMissing(['testBookings','testResults','payments']);
            $testBookingAction = new ChangeTestBookingEmailAction;
            $testResultAction = new ChangeTestResultEmailAction;
            $paymentAction = new ChangePaymentEmailAction;
            foreach ($patient->testBookings as $testBooking) {
                $testBookingAction->run($testBooking, $email);
            }
            foreach ($patient->testResults as $testResult) {
                $testResultAction->run($testResult, $email);
            }
            if (!empty($patient->email)) {
                foreach ($patient->payments as $payment) {
                    $paymentAction->run($payment, $email);
                }
            }
            $patient->update(['email' => $email]);
        });
        return $patient;
    }
}
