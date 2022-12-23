<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use App\Models\Finance\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\Payments\ProcessPaymentAction;

class ProcessPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $paymentId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Payment|int $payment)
    {
        $this->paymentId = $payment instanceof Payment ? $payment->id : $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new ProcessPaymentAction)->run($this->paymentId);
    }
}
