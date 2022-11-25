<?php

namespace App\Http\Livewire\Pages;

use App\Enums\CurrencyEnum;
use App\Helpers\FlashMessageHelper;
use Illuminate\Support\Facades\Log;
use App\Jobs\CreateOrderFromCartJob;
use Unicodeveloper\Paystack\Facades\Paystack;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Enums\Finance\Payments\PaymentMethodEnum;

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

        CreateOrderFromCartJob::dispatch($items, $this->customerEmail);
        if ($this->paymentMethodEnum == PaymentMethodEnum::PAYSTACK) {
            Log::info('redirecting to paystack');
            $this->redirectToPayStack();
        }

        if ($this->paymentMethodEnum->isHandledInternally()) {
            Cart::clear();
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

    private function redirectToPayStack()
    {
        $paystackData['email'] = $this->customerEmail;// {{-- required --}}
            $paystackData['orderID'] = 345;//
            $paystackData['amount'] = 80000;// {{-- required in kobo --}}
            $paystackData['quantity'] = 3;//
            $paystackData['currency'] = CurrencyEnum::NIGERIAN_NAIRA->value;//
            $paystackData['metadata'] = ['key_name' => 'value',];
            // For other necessary things you want to add to your payload. it is optional though
            $paystackData['reference'] = Paystack::genTranxRef();//
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
