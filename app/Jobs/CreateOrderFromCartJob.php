<?php

namespace App\Jobs;

use App\Models\User;
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

    private ?User $user = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CartCollection $items, string $customerEmail, ?User $user = null)
    {
        $this->items = $items;
        $this->customerEmail = $customerEmail;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new GenerateOrderFromCartAction())->forUser($this->user)->run($this->items, $this->customerEmail);
    }
}
