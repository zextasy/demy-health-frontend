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
use App\Actions\Discounts\LinkDiscountableAction;

class GenerateOrderFromTestBookingAction
{
    private Order $order;

    private ?User $user = null;

    private TestBooking $testBooking;

    public function run(int|TestBooking $testBooking): Order
    {
        $this->testBooking = $testBooking instanceof TestBooking ? $testBooking : TestBooking::findOrFail($testBooking);

        $customerEmail = $this->testBooking->patient->email ??  $this->testBooking->customer_email;
        $this->order = new Order;

        DB::transaction(function () use ($customerEmail) {
            $orderItemCollection = collect(
                [
                    'model' => $this->testBooking,
                    'name' => $this->testBooking->name,
                    'price' => floatval($this->testBooking->testType->price),
                    'quantity' => 1,
                ]
            );
            $orderItemCollections = collect([$orderItemCollection]);

            $this->order = (new CreateOrderAction)->withDiscounter($this->testBooking->patient)
                ->run($orderItemCollections, $customerEmail, $this->user);
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
