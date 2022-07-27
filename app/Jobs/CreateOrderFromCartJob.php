<?php

namespace App\Jobs;

use App\Actions\Orders\GenerateOrderFromCartAction;
use Darryldecode\Cart\CartCollection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateOrderFromCartJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CartCollection $items;

    private string $customerEmail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CartCollection $items, string $customerEmail)
    {
        $this->items = $items;
        $this->customerEmail = $customerEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new GenerateOrderFromCartAction())->run($this->items, $this->customerEmail);
    }
}
