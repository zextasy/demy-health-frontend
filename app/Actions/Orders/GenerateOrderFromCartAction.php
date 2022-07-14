<?php

namespace App\Actions\Orders;

use App\Models\Order;
use App\Events\CartCheckedOutEvent;
use Darryldecode\Cart\CartCollection;

class GenerateOrderFromCartAction
{

    private Order $order;

    public function run(CartCollection $cartItems, string $customerEmail): Order
    {
        //TODO move model extraction here and pass to CreateOrderAction
        $this->order = new Order;
        $user = auth()->user();

        $this->order = (new CreateOrderAction)->run($cartItems, $customerEmail, $user);

        $this->raiseEvents();

        return $this->order;
    }

    private function raiseEvents()
    {
        CartCheckedOutEvent::dispatch($this->order);
    }

}
