<?php

namespace App\Http\Livewire\Cards;

use Livewire\Component;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;

//use Cart;

class ProductItemDisplay extends Component
{
    use LivewireAlert;

    public string $imageUrl;
    public string $title;
    public ?string $description;
    public string $displayPrice;
    public float$productPrice;
    public int $productId;
    public Product $product;


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->productId = $product->id;
        $this->imageUrl = $product->latest_picture_url;
        $this->title = $product->name;
        $this->description = $product->description;
        $this->productPrice = $product->price ?? 0.0;
        $this->displayPrice = isset($product->price) ? 'NGN '.number_format($product->price) : 'Call In';
        $this->viewButtonUrl = "#";//route('product.show',product->id) TODO implement this
    }

    public function render()
    {
        return view('livewire.cards.product-item-display');
    }

    public function addToCart(){
        \Cart::add(array(
            'id' => $this->productId,
            'name' => $this->title,
            'price' => $this->productPrice,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $this->product
        ));

        $currentUrl = request()->header('Referer');
        $this->flash('success', 'Added!', [], $currentUrl);
    }

    public function showProduct(){

        $this->redirectRoute('frontend.business-units.products.show', $this->productId);
    }
}
