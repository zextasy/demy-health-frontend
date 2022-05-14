<div class="basket">
    <div class="basket-module">
        <label for="promo-code">Enter a promotional code</label>
        <input id="promo-code" type="text" name="promo-code" maxlength="5" class="promo-code-field">
        <button class="promo-code-cta">Apply</button>
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
        <livewire:pages.rows.cart-item-row
        :cart-item-id="$cartItem->id">

        </livewire:pages.rows.cart-item-row>
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
            <button class="checkout-cta" onclick="return confirm('Is your order complete?') || event.stopImmediatePropagation()"  wire:click="proceedToCheckout">Checkout</button>
        </div>
    </div>
</aside>
