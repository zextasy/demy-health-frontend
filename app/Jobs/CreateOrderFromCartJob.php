<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Darryldecode\Cart\CartCollection;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\Orders\GenerateOrderFromCartAction;

class CreateOrderFromCartJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private CartCollection $items;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CartCollection $items)
    {
        $this->items = $items;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new GenerateOrderFromCartAction())->run($this->items);
    }
}
