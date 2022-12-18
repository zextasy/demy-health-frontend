<?php

namespace App\Actions\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Actions\Invoices\ChangeInvoiceEmailAction;

class ChangeOrderEmailAction
{

    public function run(Order|int $order, string $email): Order
    {
        $order = $order instanceof Order ? $order : Order::findOrFail($order);
        DB::transaction(function () use ($email, $order) {
            $order->update(['customer_email' => $email]);
            if (isset($order->invoice)) {
                (new ChangeInvoiceEmailAction)->run($order->invoice, $email);
            }
        });

        return $order;
    }
}
