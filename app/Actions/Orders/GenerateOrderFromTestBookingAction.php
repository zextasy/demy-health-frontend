<?php

namespace App\Actions\Orders;

use App\Models\User;
use App\Models\Order;
use App\Models\TestBooking;
use Illuminate\Support\Facades\DB;
use App\Contracts\OrderableCustomerContract;
use App\Events\OrderGeneratedFromBookingEvent;

class GenerateOrderFromTestBookingAction
{
    private Order $order;

    private ?OrderableCustomerContract $orderableCustomer = null;

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

            if (empty($this->orderableCustomer)) {
                $this->orderableCustomer = $this->testBooking->patient->user;
            }

            $this->order = (new CreateOrderAction)->withDiscounter($this->testBooking->patient)
                ->run($orderItemCollections, $customerEmail, $this->orderableCustomer);
        });

        $this->raiseEvents();

        return $this->order;
    }

    public function forCustomer(?OrderableCustomerContract $orderableCustomer): self
    {
        $this->orderableCustomer = $orderableCustomer;
        return $this;
    }

    private function raiseEvents()
    {
        OrderGeneratedFromBookingEvent::dispatch($this->order);
    }
}
