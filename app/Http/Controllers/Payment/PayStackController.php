<?php

namespace App\Http\Controllers\Payment;

use Paystack;
use Illuminate\Http\Request;
use App\Models\Finance\Payment;
use App\Helpers\FlashMessageHelper;
use Illuminate\Support\Facades\Log;
use App\Actions\CreatePaymentAction;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\Controller as Controller;
use App\Enums\Finance\Payments\PaymentMethodEnum;

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
//        ray($paymentDetails);
        if ($paymentDetails['status']) {
            $paymentDataArray = $paymentDetails['data'];
            $invoiceReference = $paymentDataArray['metadata']['invoice_reference'] ?? '';
            //TODO create paystack transaction instead then payment later
            if (Payment::where('external_reference', '=', $paymentDataArray['reference'])->doesntExist()) {
                (new CreatePaymentAction)
                    ->withExternalReference($paymentDataArray['reference'])
                    ->withInternalReferences($invoiceReference)
                    ->execute($paymentDataArray['amount']/100, PaymentMethodEnum::PAYSTACK);
            }
            return redirect(route('frontend.cart.checkout-successful'));
        }
        return redirect(route('frontend.cart.checkout-failed'));
    }

    public function handleIncomingWebhook()
    {
        $paymentDetails = Paystack::getPaymentData();
        Log::info($paymentDetails);
                dd($paymentDetails);
    }
}
