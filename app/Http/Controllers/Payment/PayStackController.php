<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\FlashMessageHelper;
use Unicodeveloper\Paystack\Paystack;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller as Controller;

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

    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
