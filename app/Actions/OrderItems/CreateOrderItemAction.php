<?php

namespace App\Actions\OrderItems;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Contracts\OrderableItemContract;

class CreateOrderItemAction
{

    public function run(Order|int $order, OrderableItemContract $orderableItem, float $quantity = 1, string $name = null, float $price = null): OrderItem
    {
        $orderId = $order instanceof Order ? $order->id : $order;
        $orderItem = new OrderItem;
        $orderItem->order_id = $orderId;
        $orderItem->name = $name ?? $orderableItem->name;
        $orderItem->price = $price ?? $orderableItem->current_price;
        $orderItem->quantity = $quantity;
        $orderItem->orderable_item_type = get_class($orderableItem);
        $orderItem->orderable_item_id = $orderableItem->id;

        DB::transaction(function () use ($orderItem) {
            $orderItem->save();
        });

        return $orderItem;
    }
}
