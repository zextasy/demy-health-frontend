<?php

namespace App\Jobs;

use App\Models\TestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\Orders\GenerateOrderFromTestBookingAction;

class GenerateOrderFromBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private TestBooking $testBooking;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TestBooking $testBooking)
    {
        $this->testBooking = $testBooking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new GenerateOrderFromTestBookingAction)->run($this->testBooking);
    }
}
