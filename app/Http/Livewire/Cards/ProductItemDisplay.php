<?php

namespace App\Http\Livewire\Cards;

use App\Events\ProductAddedToCartEvent;
use App\Helpers\FlashMessageHelper;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProductItemDisplay extends Component
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

    protected $listeners = [
        'postProductAddedCart' => 'goToCart',
        'postProductAddedContinue' => 'continueShopping',
    ];

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
        $this->viewButtonUrl = '#'; //route('product.show',product->id) TODO implement this
    }

    public function render()
    {
        return view('livewire.cards.product-item-display');
    }

    public function addToCart()
    {
        Cart::add([
            'id' => 'Product - '.$this->sku,
            'name' => $this->title,
            'price' => $this->productPrice,
            'quantity' => 1,
            'attributes' => [
                'type' => Product::class,
            ],
            'associatedModel' => $this->product,
        ]);


        ProductAddedToCartEvent::dispatch();
        $this->alert('success', FlashMessageHelper::PRODUCT_ADD_TO_CART_SUCCESSFUL, [
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'View Cart',
            //                'showDenyButton' => true,
            //                'denyButtonText' => 'Cancel',
            'showCancelButton' => true,
            'cancelButtonText' => 'Continue Shopping',
            'onConfirmed' => 'postProductAddedCart',
            'onDismissed' => 'postProductAddedContinue',
            'allowOutsideClick' => false,
            'timer' => null,
        ]);
    }

    public function showProduct()
    {
        $this->redirectRoute('frontend.business-units.products.show', $this->productId);
    }

    public function goToCart()
    {
        $this->redirect(route('frontend.cart.display'));
    }

    public function continueShopping()
    {
        $currentUrl = request()->header('Referer');
        $this->redirect($currentUrl);
    }
}
