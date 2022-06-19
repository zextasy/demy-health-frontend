<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Helpers\FlashMessageHelper;
use App\Jobs\CreateOrderFromCartJob;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartCheckout extends Component
{
    use LivewireAlert;

    public Collection $cartItems;
    public float $cartTotal;
    public $cartSubTotal;
    public string $customerEmail;
    public bool $canCheckOut;

    public function mount(string $customerEmail)
    {
        $this->customerEmail = $customerEmail;
        $this->cartTotal = Cart::getTotal();
        $this->cartSubTotal = Cart::getSubTotal();
        $this->cartItems = Cart::getContent();
        $this->canCheckOut = $this->canCheckout();
    }



    public function render()
    {
        return view('livewire.pages.cart-checkout');
    }

    public function checkoutCart()
    {
        $items = Cart::getContent();

        if ($this->cannotCheckout()){
            $this->flash('warning', FlashMessageHelper::BLANK, [], '/');
            return;
        }

        CreateOrderFromCartJob::dispatch($items,$this->customerEmail);
        Cart::clear();
        $this->flash('success', FlashMessageHelper::ORDER_BOOKING_SUCCESSFUL, [], '/');
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
        return !$this->cannotCheckout();
    }
}
