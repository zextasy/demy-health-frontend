<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\TestBookings\DeleteTestBookingAction;
use App\Actions\Invoices\GenerateInvoiceForOrderAction;

class DeleteTestBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $testBookingId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int|TestBooking $testBooking)
    {
        $this->testBookingId = $testBooking instanceof TestBooking ? $testBooking->id : $testBooking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new DeleteTestBookingAction)->run($this->testBookingId);
    }
}
