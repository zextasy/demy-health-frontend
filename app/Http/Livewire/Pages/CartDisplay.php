<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Helpers\FlashMessageHelper;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CheckoutCartRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class CartDisplay extends Component
{
    use LivewireAlert;

    public Collection $cartItems;
    public float $cartTotal;
    public $cartSubTotal;
    public int $paymentMethod;
    public ?string $customerEmail = null;

    protected $listeners = [
        'cartItemDeleted' => 'removeItem',
        'cartItemQuantityUpdated' => 'updateCartTotals'
    ];

    protected function rules(): array
    {
        return (new CheckoutCartRequest())->rules();
    }

    public function mount()
    {
        $this->updateCartTotals();
        $this->cartItems = Cart::getContent();
        $this->customerEmail = $this->getCustomerEmail();
        $this->paymentMethod = PaymentMethodEnum::OTHER->value;
    }

    public function updateCartTotals()
    {
        $this->cartTotal = Cart::getTotal();
        $this->cartSubTotal = Cart::getSubTotal();
    }

    public function render()
    {
        return view('livewire.pages.cart-display');
    }

    public function removeItem(int $itemId)
    {
        Cart::remove($itemId);
        $currentUrl = request()->header('Referer');
        $this->flash('success', 'Removed!', [], $currentUrl);
    }

    public function proceedToCheckout()
    {
        $this->validate();
        $this->flash('success', FlashMessageHelper::BLANK, [], route('frontend.cart.checkout',['customer_email' => $this->customerEmail]));
    }

    private function getCustomerEmail(): string
    {
        if (auth()->user()){
        return auth()->user()->email;
        }

        return Session::get('customerEmail') ?? "";
    }
}
