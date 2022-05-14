<?php

namespace App\Http\Livewire\Pages\Rows;

use Livewire\Component;

class CartItemRow extends Component
{
    public int $cartItemId;
    public int $initialQuantity;
    public mixed $updatedQuantity;
    public float $subTotal;
    public string $itemName;
    public string $pictureUrl;
    public string $model;
    public ?string $description;
    public string $itemPrice;

    public function mount(int $cartItemId)
    {
        $this->cartItemId = $cartItemId;
        $cartItem = \Cart::get($this->cartItemId);
        $this->subTotal = \Cart::get($cartItemId)->getPriceSum();
        $this->updatedQuantity = $cartItem->quantity;
        $this->initialQuantity = $cartItem->quantity;
        $this->itemPrice = $cartItem->price;
        $this->itemName = $cartItem->name;
        $this->pictureUrl = $cartItem->associatedModel->latest_picture_url;
        $this->model = $cartItem->associatedModel->model;
        $this->description = $cartItem->associatedModel->description;
        //        ray($this->cartItem)->purple();
    }

    public function render()
    {
        return view('livewire.pages.rows.cart-item-row');
    }

    public function itemDeleted()
    {
        $cartItem = \Cart::get($this->cartItemId);
        ray($cartItem, $cartItem->id)->orange();
        $this->emit('cartItemDeleted', $cartItem->id);
    }

    public function itemQuantityUpdated()
    {
        $integerQuantity = intval($this->updatedQuantity);

        if ($integerQuantity > 0) {
            \Cart::update($this->cartItemId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $integerQuantity,
                ),
            ));
            $this->initialQuantity = $integerQuantity;
        }

    }
}
