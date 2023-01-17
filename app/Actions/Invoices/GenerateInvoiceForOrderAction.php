<?php

namespace App\Actions\Invoices;

use App\Models\Order;
use App\Models\Finance\Invoice;
use Illuminate\Support\Collection;
use App\Events\InvoiceCreatedFromCartEvent;

class GenerateInvoiceForOrderAction
{
    private Invoice $invoice;


    public function run(Order|int $order): Invoice
    {
        $order = $order instanceof Order ?
            $order->loadMissing(['items.orderableItem'])
            : Order::with(['items.orderableItem'])->findOrFail($order);
        $this->invoice = new Invoice;
        $orderableItemModelCollection = new Collection();
        foreach ($order->items as $orderItem) {
            // model, name, price, qty
            $orderableItemCollection = collect(
                [
                    'model' => $orderItem->orderableItem ?? $orderItem->orderable_item,
                    'name' => $orderItem->name,
                    'price' => floatval($orderItem->price),
                    'quantity' => $orderItem->quantity,
                ]
            );
            $orderableItemModelCollection->push($orderableItemCollection);
        }

        $this->invoice = (new CreateInvoiceAction)
            ->forInvoiceable($order)
            ->forCustomer($order->customer)
            ->run($orderableItemModelCollection, $order->customer_email);

        $this->raiseEvents();

        return $this->invoice;
    }



    private function raiseEvents()
    {
        InvoiceCreatedFromCartEvent::dispatch($this->invoice);
    }
}
