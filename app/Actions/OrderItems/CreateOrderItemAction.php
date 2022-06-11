<?php

namespace App\Actions\OrderItems;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Contracts\OrderableItemContract;

class CreateOrderItemAction
{

    public function run(Order|int $order, OrderableItemContract $orderableItem, string $name, float $price, int $quantity): OrderItem
    {
        $orderId = $order instanceof Order ? $order->id : $order;
        $orderItem = new OrderItem;
        $orderItem->order_id = $orderId;
        $orderItem->name = $name;
        $orderItem->price = $price;
        $orderItem->quantity = $quantity;
        $orderItem->orderable_item_type = get_class($orderableItem);
        $orderItem->orderable_item_id = $orderableItem->id;

        DB::transaction(function () use ($orderItem) {
            $orderItem->save();
        });

        return $orderItem;
    }
}
