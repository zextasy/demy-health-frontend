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

    public function run(Collection $orderItems, string $customerEmail, OrderableContract $orderable = null): Order
    {
        $this->order = new Order;
        $this->order->customer_email = $customerEmail;
        $this->order->orderable_id = $orderable?->getLaravelMorphModelId();
        $this->order->orderable_type = $orderable?->getLaravelMorphModelType();
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

    private function raiseEvents()
    {
        OrderCreatedEvent::dispatch($this->order);
    }
}
