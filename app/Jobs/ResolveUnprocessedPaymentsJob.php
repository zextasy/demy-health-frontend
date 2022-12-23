<?php

namespace App\Jobs;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use App\Models\Finance\Payment;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResolveUnprocessedPaymentsJob implements ShouldQueue
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
        $unresolvedPayments = Payment::needsProcessing()->get();
        ray($unresolvedPayments);
        foreach ($unresolvedPayments as $payment) {
            ProcessPaymentJob::dispatch($payment);
        }
    }
}
