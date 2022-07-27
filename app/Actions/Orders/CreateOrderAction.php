<?php

namespace App\Actions\Orders;

use App\Actions\OrderItems\CreateOrderItemAction;
use App\Contracts\OrderableContract;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Events\OrderCreatedEvent;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        if (isset($paymentMethod)) {
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
