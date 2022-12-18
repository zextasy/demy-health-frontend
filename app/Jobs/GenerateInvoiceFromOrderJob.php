<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\Invoices\GenerateInvoiceForOrderAction;

class GenerateInvoiceFromOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $orderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order|int $order)
    {
        $this->orderId = $order instanceof Order ? $order->id : $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new GenerateInvoiceForOrderAction)->run($this->orderId);
    }
}
