<?php

namespace App\Http\Livewire\Cards;

use Livewire\Component;
use App\Models\Product;
use App\Helpers\FlashMessageHelper;
use App\Events\ProductAddedToCartEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class ProductItemDetail extends Component
{
    use LivewireAlert;

    public string $imageUrl;
    public string $title;
    public ?string $description;
    public string $displayPrice;
    public float$productPrice;
    public int $productId;
    public string $sku;
    public Product $product;


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->productId = $product->id;
        $this->sku = $product->sku;
        $this->imageUrl = $product->latest_picture_url;
        $this->title = $product->name;
        $this->description = $product->description;
        $this->productPrice = $product->price ?? 0.0;
        $this->displayPrice = isset($product->price) ? 'NGN '.number_format($product->price) : 'Call In';
    }

    public function render()
    {
        return view('livewire.cards.product-item-detail');
    }

    public function addToCart(){
        Cart::add(array(
            'id' => 'Product - '.$this->sku,
            'name' => $this->title,
            'price' => $this->productPrice,
            'quantity' => 1,
            'attributes' => array(
                'type' => Product::class
            ),
            'associatedModel' => $this->product
        ));

        $currentUrl = request()->header('Referer');
        ProductAddedToCartEvent::dispatch();
        $this->flash('success', FlashMessageHelper::PRODUCT_ADD_TO_CART_SUCCESSFUL, [], $currentUrl);
    }
}
