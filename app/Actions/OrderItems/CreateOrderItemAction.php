<?php

namespace App\Actions\OrderItems;

use App\Contracts\OrderableItemContract;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CreateOrderItemAction
{
    public function run(Order|int $order, OrderableItemContract $orderableItem, float $quantity = 1, string $name = null, float $price = null): OrderItem
    {
        $orderId = $order instanceof Order ? $order->id : $order;
        $orderItem = new OrderItem;
        $orderItem->order_id = $orderId;
        $orderItem->name = $name ?? $orderableItem->getOrderableItemName();
        $orderItem->price = $price ?? $orderableItem->getOrderableItemPrice();
        $orderItem->quantity = $quantity;
        $orderItem->orderable_item_type = $orderableItem->getLaravelMorphModelType();
        $orderItem->orderable_item_id = $orderableItem->getLaravelMorphModelId();

        DB::transaction(function () use ($orderItem) {
            $orderItem->save();
        });

        return $orderItem;
    }
}
