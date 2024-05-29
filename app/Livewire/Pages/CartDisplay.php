<?php

namespace App\Livewire\Pages;

use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Helpers\FlashMessageHelper;
use App\Http\Requests\CheckoutCartRequest;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CartDisplay extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public Collection $cartItems;

    public float $cartTotal;

    public $cartSubTotal;

    public ?int $paymentMethod = null;

    public ?string $customerEmail = null;

    protected $listeners = [
        'cartItemDeleted' => 'removeItem',
        'cartItemQuantityUpdated' => 'updateCartTotals',
    ];

    protected function rules(): array
    {
        return (new CheckoutCartRequest())->rules();
    }

    public function mount()
    {
        $this->updateCartTotals();
        $this->cartItems = Cart::getContent();
        $this->customerEmail = $this->getSessionCustomerEmail();
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
        $currentUrl = request()->header('Referer');
        Cart::remove($itemId);

        $this->flash('success', 'Removed!', [], $currentUrl);
    }

    public function proceedToCheckout()
    {
        $currentUrl = request()->header('Referer');
        try {
            $this->setSessionCustomerEmail($this->customerEmail);
            $this->validate();
        } catch (\Throwable $th) {
            $this->flash('error', $th->getMessage(), [], $currentUrl);

            return;
        }

        $this->flash('success', FlashMessageHelper::BLANK, [], route('frontend.cart.checkout', ['customer_email' => $this->customerEmail,'payment_method' => $this->paymentMethod]));
    }
}
