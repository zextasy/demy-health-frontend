<?php

namespace App\Http\Livewire\Pages\Rows;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class CartItemRow extends Component
{
    public string $cartItemId;

    public int $initialQuantity;

    public mixed $updatedQuantity;

    public float $subTotal;

    public string $itemName;

    public ?string $pictureUrl;

    public ?string $model;

    public ?string $description;

    public ?string $itemPrice;

    public function mount(string $cartItemId)
    {
        $this->cartItemId = $cartItemId;
        $cartItem = Cart::get($this->cartItemId);
        $this->subTotal = Cart::get($cartItemId)->getPriceSum();
        $this->updatedQuantity = $cartItem->quantity;
        $this->initialQuantity = $cartItem->quantity;
        $this->itemPrice = $cartItem->price;
        $this->itemName = $cartItem->name;
        $this->pictureUrl = optional($cartItem->associatedModel)->latest_picture_url;
        $this->model = optional($cartItem->associatedModel)->model;
        $this->description = optional($cartItem->associatedModel)->description;
    }

    public function render()
    {
        return view('livewire.pages.rows.cart-item-row');
    }

    public function itemDeleted()
    {
        $this->emit('cartItemDeleted', $this->cartItemId);
    }

    public function itemQuantityUpdated()
    {
        $integerQuantity = intval($this->updatedQuantity);

        if ($integerQuantity > 0) {
            Cart::update($this->cartItemId, [
                'quantity' => [
                    'relative' => false,
                    'value' => $integerQuantity,
                ],
            ]);
            $this->initialQuantity = $integerQuantity;
            $this->updateCartItemSubTotal();
            $this->emit('cartItemQuantityUpdated');
        }
    }

    public function updateCartItemSubTotal()
    {
        $this->subTotal = Cart::get($this->cartItemId)->getPriceSum();
    }
}
