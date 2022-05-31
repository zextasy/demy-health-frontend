<div>
    <div class="basket">
        <div class="basket-module">
            <p>Promotional Code : <strong> </strong> </p>
        </div>
        <div class="basket-labels">
            <ul>
                <li class="item item-heading">Item</li>
                <li class="price">Price</li>
                <li class="quantity">Quantity</li>
                <li class="subtotal">Subtotal</li>
            </ul>
        </div>
        @foreach($cartItems as $cartItem)
            <x-cart-item-row
                :picture-url="optional($cartItem->associatedModel)->latest_picture_url"
                :quantity="$cartItem->quantity"
                :item-name="$cartItem->name"
                :item-price="$cartItem->price"
                :model="optional($cartItem->associatedModel)->model"
                :description="optional($cartItem->associatedModel)->description"
                :sub-total="Cart::get($cartItem->id)->getPriceSum()">

            </x-cart-item-row>
        @endforeach
    </div>
    <aside>
        <div class="summary">
            <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
            <div class="summary-subtotal">
                <div class="subtotal-title">Subtotal</div>
                <div class="subtotal-value final-value" id="basket-subtotal">{{number_format($cartSubTotal)}}</div>
                <div class="summary-promo hide">
                    <div class="promo-title">Promotion</div>
                    <div class="promo-value final-value" id="basket-promo"></div>
                </div>
            </div>
            <div class="summary-delivery">
                {{--            <select name="delivery-collection" class="summary-delivery-selection">--}}
                {{--                <option value="0" selected="selected">Select Collection or Delivery</option>--}}
                {{--                <option value="collection">Collection</option>--}}
                {{--                <option value="first-class">Royal Mail 1st Class</option>--}}
                {{--                <option value="second-class">Royal Mail 2nd Class</option>--}}
                {{--                <option value="signed-for">Royal Mail Special Delivery</option>--}}
                {{--            </select>--}}
            </div>
            <div class="summary-total">
                <div class="total-title">Total</div>
                <div class="total-value final-value" id="basket-total">{{number_format($cartTotal)}}</div>
            </div>
            <div class="summary-checkout">
                <button class="checkout-cta"  wire:click="checkoutCart">Checkout</button>
                <br>
                <button class="checkout-cta btn-danger"  wire:click="proceedToCheckout">Cancel</button>
            </div>
        </div>
    </aside>
</div>
