<?php

namespace App\Jobs;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use App\Models\Finance\Payment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Actions\Payments\ChangePaymentEmailAction;
use App\Actions\TestBookings\ChangeTestBookingEmailAction;

class ResolvePatientEmailIssueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $defaultEmail = config('constants.default_email');
        $testBookingsWithWrongEmails = TestBooking::query()
            ->with(['patient', 'orderItems', 'orderItems.order', 'orderItems.order.invoice'])
            ->whereNull('customer_email')
            ->orWhereIn('customer_email', ['info@demyhealth.com',$defaultEmail])
            ->get();
        foreach ($testBookingsWithWrongEmails as $testBooking) {
            $patientEmail = $testBooking->patient->email ?? $defaultEmail;
            (new ChangeTestBookingEmailAction)->run($testBooking, $patientEmail);
        }

        $paymentsWithWrongEmails = Payment::query()
            ->with(['transactions'])
            ->whereNull('customer_email')
            ->orWhereIn('customer_email', ['info@demyhealth.com',$defaultEmail])
            ->get();
        foreach ($paymentsWithWrongEmails as $payment) {
            $latestTransaction = $payment->transactions()->latest()->first();
            if (isset($latestTransaction)) {
                $patientEmail = $latestTransaction->creditable->customer_email ?? $defaultEmail;
                (new ChangePaymentEmailAction)->run($payment, $patientEmail);
            }

        }
    }
}
