<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Helpers\FlashMessageHelper;
use App\Http\Requests\CheckoutCartRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartDisplay extends Component
{
    use LivewireAlert;

    public Collection $cartItems;
    public float $cartTotal;
    public $cartSubTotal;
    public string $paymentMethod = ""; //TODO use PAYMENTOPTIONSENUM
    public string $customerEmail = "";

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
}
