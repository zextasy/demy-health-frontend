<?php

namespace App\Actions\Orders;

use App\Models\User;
use App\Models\Order;
use App\Models\Patient;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Contracts\OrderableContract;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Actions\Patients\CreatePatientAction;
use App\Actions\Addresses\CreateAddressAction;
use App\Actions\OrderItems\CreateOrderItemAction;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Actions\Addresses\AttachAddressableAction;
use App\Actions\TestBookings\CreateTestBookingAction;

class CreateOrderAction
{

    private Order $order;

    private ?PaymentMethodEnum $paymentMethod;

    public function run(Collection $orderItems, string $customerEmail, OrderableContract $orderable = null): Order
    {
        $this->order = new Order;
        $this->order->customer_email = $customerEmail;
        $this->order->orderable_id = $orderable?->id;
        $this->order->orderable_type = isset($orderable) ? get_class($orderable) : null;
        $this->order->payment_method = $this->paymentMethod ?? PaymentMethodEnum::OTHER;
        DB::transaction(function () use ($orderItems) {
            $this->order->save();
            foreach ($orderItems as $orderableItemCollection) {
                (new CreateOrderItemAction)
                    ->run(
                        $this->order,
                        $orderableItemCollection->get('model'),
                        $orderableItemCollection->get('quantity'),
                        $orderableItemCollection->get('name'),
                        floatval($orderableItemCollection->get('price'))
                    );
            }
        });

        $this->raiseEvents();

        return $this->order;
    }

    public function withPaymentMethod(null|int|PaymentMethodEnum $paymentMethod): self
    {
        if (isset($paymentMethod)){
            $paymentMethod = is_int($paymentMethod) ? PaymentMethodEnum::from($paymentMethod) : $paymentMethod;
        }
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    private function raiseEvents()
    {
        OrderCreatedEvent::dispatch($this->order);
    }

}
