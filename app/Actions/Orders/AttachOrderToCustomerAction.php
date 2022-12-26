<?php

namespace App\Actions\Orders;

use Exception;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Contracts\OrderableCustomerContract;
use App\Actions\Invoices\AttachInvoiceToCustomerAction;

class AttachOrderToCustomerAction
{

    public function run(Order|int $order, OrderableCustomerContract $customer): bool
    {
        $order = $order instanceof Order ? $order : Order::findOrFail($order);
        $order->loadMissing(['invoice']);
        try {
            DB::transaction(function () use ($customer, $order) {
                $order->customer_id = $customer->getLaravelMorphModelId();
                $order->customer_type = $customer->getLaravelMorphModelType();
                $order->save();
                if (isset($order->invoice)) {
                    (new AttachInvoiceToCustomerAction)->run($order->invoice, $customer);
                }

            });

            return true;
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
