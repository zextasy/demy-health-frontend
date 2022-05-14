<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CartDisplay extends Component
{
    use LivewireAlert;

    public Collection $cartItems;
    public float $cartTotal;
    public $cartSubTotal;

    protected $listeners = [
        'cartItemDeleted' => 'removeItem',
    ];

    public function mount()
    {
        $this->cartTotal = \Cart::getTotal();
        $this->cartSubTotal = \Cart::getSubTotal();
        $this->cartItems = \Cart::getContent();
    }

    public function updated()
    {
        $this->cartTotal = \Cart::getTotal();
        $this->cartSubTotal = \Cart::getSubTotal();
    }

    public function render()
    {
        return view('livewire.pages.cart-display');
    }

    public function removeItem(int $itemId)
    {
        \Cart::remove($itemId);
        $currentUrl = request()->header('Referer');
        $this->flash('success', 'Removed!', [], $currentUrl);
    }

    public function proceedToCheckout()
    {
        ray('Checkout function');
//        $cartItems = \Cart::getContent();
//        OrderMadeEvent::dispatch($cartItems);
        $this->flash('success', 'Your order has been booked!', [], '/');
    }
}
