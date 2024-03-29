<?php

namespace App\Actions\TestBookings;

use App\Models\TestBooking;
use Illuminate\Support\Facades\DB;
use App\Actions\Orders\ChangeOrderEmailAction;

class ChangeTestBookingEmailAction
{

    public function run(TestBooking|int $testBooking, string $email): TestBooking
    {
        $testBooking = $testBooking instanceof TestBooking ? $testBooking : TestBooking::findOrFail($testBooking);
        DB::transaction(function () use ($email, $testBooking) {
            $testBooking->loadMissing(['orderItems.order']);
            $action = new ChangeOrderEmailAction;
            foreach ($testBooking->orderItems as $orderItem) {
                if (isset($orderItem->order)) {
                    $action->run($orderItem->order, $email);
                }

            }
            $testBooking->update(['customer_email' => $email]);
        });

        return $testBooking;
    }
}
