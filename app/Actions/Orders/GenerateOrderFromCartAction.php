<?php

namespace App\Actions\Orders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\TestBooking;
use App\Helpers\TestBookingHelper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Events\CartCheckedOutEvent;
use Darryldecode\Cart\CartCollection;
use Illuminate\Database\Eloquent\Model;

class GenerateOrderFromCartAction
{
    private Order $order;

    private TestBookingHelper $testBookingHelper;
    private ?User $user = null;

    public function __construct()
    {
        $this->testBookingHelper = new TestBookingHelper();
    }

    public function run(CartCollection $cartItems, string $customerEmail): Order
    {
        //TODO move model extraction here and pass to CreateOrderAction
        $this->order = new Order;

        DB::transaction(function () use ($customerEmail, $cartItems) {
            $cartItemModelCollection = new Collection();
            foreach ($cartItems as $cartItem) {
                // model, name, price, qty
                $orderableItemCollection = collect(
                    [
                        'model' => $this->getModelForCartItem($cartItem),
                        'name' => $cartItem->name,
                        'price' => floatval($cartItem->price),
                        'quantity' => $cartItem->quantity,
                    ]
                );
                $cartItemModelCollection->push($orderableItemCollection);
            }
            $this->order = (new CreateOrderAction)->run($cartItemModelCollection, $customerEmail, $this->user);
        });

        $this->raiseEvents();

        return $this->order;
    }

    public function forUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    private function getModelForCartItem(mixed $cartItem): Model
    {
        return match ($cartItem->attributes->type) {
            TestBooking::class => $this->testBookingHelper->getTestBookingFromCartItem($cartItem),
            Product::class => $cartItem->associatedModel,
        };
    }

    private function raiseEvents()
    {
        CartCheckedOutEvent::dispatch($this->order);
    }
}
