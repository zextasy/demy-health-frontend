<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Helpers\FlashMessageHelper;
use App\Jobs\CreateOrderFromCartJob;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Actions\Orders\GenerateOrderFromCartAction;

class CartCheckout extends Component
{
    use LivewireAlert;

    public Collection $cartItems;
    public float $cartTotal;
    public $cartSubTotal;

    public function mount()
    {
        $this->cartTotal = Cart::getTotal();
        $this->cartSubTotal = Cart::getSubTotal();
        $this->cartItems = Cart::getContent();
    }

    public function render()
    {
        return view('livewire.pages.cart-checkout');
    }

    public function checkoutCart()
    {
        $items = Cart::getContent();
        CreateOrderFromCartJob::dispatch($items);
        Cart::clear();
        $this->flash('success', FlashMessageHelper::ORDER_BOOKING_SUCCESSFUL, [], '/');
    }

    public function cancelCheckout()
    {
        $this->flash('success', FlashMessageHelper::BLANK, [], '/');
    }
}
