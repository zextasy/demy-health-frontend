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
use App\Events\OrderGeneratedFromBookingEvent;

class GenerateOrderFromTestBookingAction
{
    private Order $order;

    private ?User $user = null;

    public function run(TestBooking $testBooking): Order
    {

        $customerEmail = $testBooking->patient->email ??  $testBooking->customer_email;
        $this->order = new Order;

        DB::transaction(function () use ($customerEmail, $testBooking) {
            $orderItemCollection = collect(
                [
                    'model' => $testBooking,
                    'name' => $testBooking->name,
                    'price' => floatval($testBooking->testType->price),
                    'quantity' => 1,
                ]
            );
            $orderItemCollections = collect([$orderItemCollection]);
            ray($customerEmail, $testBooking->patient->customer_email, $testBooking->customer_email);

            $this->order = (new CreateOrderAction)->run($orderItemCollections, $customerEmail, $this->user);
        });

        $this->raiseEvents();

        return $this->order;
    }

    public function forUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    private function raiseEvents()
    {
        OrderGeneratedFromBookingEvent::dispatch($this->order);
    }
}
