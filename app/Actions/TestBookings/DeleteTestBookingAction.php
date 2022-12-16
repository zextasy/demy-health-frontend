<?php

namespace App\Actions\TestBookings;

use Exception;
use App\Models\TestBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Actions\Orders\DeleteOrderAction;
use App\Actions\TestResults\DeleteTestResultAction;

class DeleteTestBookingAction
{

    public function run(TestBooking|int|null $testBooking): bool
    {
        if (empty($testBooking)) {
            return true;
        }

        $testBooking = $testBooking instanceof TestBooking ? $testBooking : TestBooking::findOrFail($testBooking);
        $testBooking->loadMissing(['orderItems.order', 'invoiceItems.invoice','testResults']);

        try {
            DB::transaction(function () use ($testBooking) {
                foreach ($testBooking->orderItems as $orderItem) {
                    (new DeleteOrderAction)->run($orderItem->order);
                }
                foreach ($testBooking->testResults as $testResult) {
                    (new DeleteTestResultAction)->run($testResult);
                }
                $testBooking->delete();
            });

            return true;
        }
        catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
