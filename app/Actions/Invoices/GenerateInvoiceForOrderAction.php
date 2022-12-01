<?php

namespace App\Actions\Invoices;

use App\Models\Order;
use App\Models\Finance\Invoice;
use Illuminate\Support\Collection;
use App\Events\InvoiceCreatedFromCartEvent;

class GenerateInvoiceForOrderAction
{
    private Invoice $invoice;


    public function run(Order $order): Invoice
    {
        $this->invoice = new Invoice;
        $orderableItemModelCollection = new Collection();
        foreach ($order->items as $orderItem) {
            // model, name, price, qty
            $orderableItemCollection = collect(
                [
                    'model' => $orderItem->orderableItem,
                    'name' => $orderItem->name,
                    'price' => floatval($orderItem->price),
                    'quantity' => $orderItem->quantity,
                ]
            );
            $orderableItemModelCollection->push($orderableItemCollection);
        }

        $this->invoice = (new CreateInvoiceAction)
            ->forInvoiceable($order)
            ->forInvoiceableCustomer($order->customer)
            ->run($orderableItemModelCollection, $order->customer_email);

        $this->raiseEvents();

        return $this->invoice;
    }



    private function raiseEvents()
    {
        InvoiceCreatedFromCartEvent::dispatch($this->invoice);
    }
}
