<?php

namespace App\Http\Controllers\Payment;

use Paystack;
use Illuminate\Http\Request;
use App\Helpers\FlashMessageHelper;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as Controller;
use App\Actions\PaystackTransactions\RecordPaystackTransactionAction;

class PayStackController extends Controller
{

    public function redirectToGateway()
    {
        $data = array(
            "amount" => 700 * 100,
            "reference" => '4g4g5485g8545jg8gj',
            "email" => 'user@mail.com',
            "currency" => "NGN",
            "orderID" => 23456,
        );
        try {
            return Paystack::getAuthorizationUrl($data)->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>FlashMessageHelper::PAYSTACK_ERROR, 'type'=>'error']);
        }
    }

    public function handleGatewayCallback(Request $request)
    {
        $paymentDetails = Paystack::getPaymentData();
        $route = route('frontend.cart.checkout-successful');
        $status = boolval($paymentDetails['status']);
        if (!$status) {
            $route = redirect(route('frontend.cart.checkout-failed'));
        }
        $paymentDataArray = $paymentDetails['data'];
        (new RecordPaystackTransactionAction)->run($status, $paymentDataArray);
        return redirect($route);
    }

    public function handleIncomingWebhook()
    {
        $paymentDetails = Paystack::getPaymentData();
        ray($paymentDetails);
    }
}
