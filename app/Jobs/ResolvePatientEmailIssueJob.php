<?php

namespace App\Jobs;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
        $testBookingsWithWrongEmails = TestBooking::query()
            ->with(['patient', 'orderItems', 'orderItems.order', 'orderItems.order.invoice'])
            ->whereNull('customer_email')
            ->orWhereIn('customer_email', ['info@demyhealth.com','care@demyhealth.com'])
            ->get();
        foreach ($testBookingsWithWrongEmails as $testBooking) {
            $patientEmail = $testBooking->patient->email ?? 'care@demyhealth.com';
            (new ChangeTestBookingEmailAction)->run($testBooking, $patientEmail);
        }
    }
}
