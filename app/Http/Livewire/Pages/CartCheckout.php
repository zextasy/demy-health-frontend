<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Enums\CurrencyEnum;
use App\Models\Finance\Invoice;
use Illuminate\Support\Collection;
use App\Helpers\FlashMessageHelper;
use Illuminate\Support\Facades\Log;
use Unicodeveloper\Paystack\Facades\Paystack;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Actions\Orders\GenerateOrderFromCartAction;
use App\Actions\Invoices\GenerateInvoiceForOrderAction;

class CartCheckout extends Component
{
    use LivewireAlert;

    public Collection $cartItems;

    public float $cartTotal;

    public $cartSubTotal;

    public string $customerEmail;

    public bool $canCheckOut;

    public bool $needsAccountDetails;

    public PaymentMethodEnum $paymentMethodEnum;


    public function mount(string $customerEmail, int $paymentMethod)
    {

        $this->customerEmail = $customerEmail;
        $this->paymentMethodEnum = PaymentMethodEnum::from($paymentMethod);
        $this->cartTotal = Cart::getTotal();
        $this->cartSubTotal = Cart::getSubTotal();
        $this->cartItems = Cart::getContent();
        $this->canCheckOut = $this->canCheckout();
        $this->needsAccountDetails = $this->needsAccountDetails();
    }

    public function render()
    {
        return view('livewire.pages.cart-checkout');
    }

    public function checkoutCart()
    {
        $items = Cart::getContent();

        if ($this->cannotCheckout()) {
            $this->flash('warning', FlashMessageHelper::BLANK, [], '/');

            return;
        }

        try {
            $order = (new GenerateOrderFromCartAction())->forUser(auth()->user())->run($items, $this->customerEmail);
            $invoice = (new GenerateInvoiceForOrderAction)->run($order);
        } catch (\Exception $e) {
            Log::info($e);
            $this->flash('warning', FlashMessageHelper::CHECKOUT_ERROR, [], '/');
        }

        Cart::clear();
        if ($this->paymentMethodEnum == PaymentMethodEnum::PAYSTACK) {
            Log::info('redirecting to paystack');

            $this->redirectToPayStack($invoice);
        }

        if ($this->paymentMethodEnum->isHandledInternally()) {

            $this->flash('success', FlashMessageHelper::ORDER_BOOKING_SUCCESSFUL, [], '/');
        }

    }

    public function cancelCheckout()
    {
        $this->flash('success', FlashMessageHelper::BLANK, [], '/');
    }

    public function cannotCheckout(): bool
    {
        return Cart::isEmpty();
    }

    public function canCheckout(): bool
    {
        return ! $this->cannotCheckout();
    }

    private function needsAccountDetails(): bool
    {
        return $this->paymentMethodEnum == PaymentMethodEnum::BANK_TRANSFER
            || $this->paymentMethodEnum == PaymentMethodEnum::OTHER;
    }

    private function redirectToPayStack(Invoice $invoice)
    {
        $paystackData['email'] = $this->customerEmail;// {{-- required --}}
//            $paystackData['reference'] = $invoice->reference;
            $paystackData['amount'] = $invoice->total_amount * 100;// {{-- required --}}
            $paystackData['currency'] = CurrencyEnum::NIGERIAN_NAIRA->value;
            $paystackData['metadata'] = ['invoice_reference' => $invoice->reference,];
//            $paystackData['callback'] = route('paystack.handle-gateway-callback', $invoice->reference);
            // For other necessary things you want to add to your payload. it is optional though
        try {
            $paystackAuthorization = Paystack::getAuthorizationUrl($paystackData);
            redirect()->away($paystackAuthorization->url);
        } catch (\Exception $e) {
            Log::info($e);
            $currentUrl = request()->header('Referer');
            $this->flash('warning', FlashMessageHelper::PAYSTACK_ERROR, [], $currentUrl);
        }
    }
}
