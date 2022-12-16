<?php

namespace App\Actions\Orders;

use Exception;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Actions\Invoices\DeleteInvoiceAction;

class DeleteOrderAction
{

    public function run(Order|int|null $order): bool
    {
        if (empty($order)) {
            return true;
        }
        $order = $order instanceof Order ? $order : Order::findOrFail($order);
        $order->loadMissing(['items','invoice']);
        try {
            DB::transaction(function () use ($order) {
                if (isset($order->invoice)) {
                    (new DeleteInvoiceAction)->run($order->invoice);
                }
                $order->items()->delete();
                $order->delete();
            });

            return true;
        }
        catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }
}
