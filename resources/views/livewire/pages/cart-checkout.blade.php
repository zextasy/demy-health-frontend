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
        @if($needsAccountDetails)
            <div>
                <h2>Account Details</h2>
                <p>{{app(\App\Settings\GeneralSettings::class)->account_transfer_details}}</p>
            </div>
        @endif
    </div>
    <aside>
        <div class="summary">
            <div class="summary-total-items"><span class="total-items"></span> Items in your Cart</div>
            <div class="summary-subtotal">
                <div class="subtotal-title">Subtotal</div>
                <div class="subtotal-value final-value" id="basket-subtotal">{{number_format($cartSubTotal)}}</div>
                <div class="summary-promo hide">
                    <div class="promo-title">Promotion</div>
                    <div class="promo-value final-value" id="basket-promo"></div>
                </div>
            </div>
            <div class="summary-delivery">
                <p>Payment Method : <strong>{{$paymentMethodEnum->name}}</strong> </p>
                <p>Customer Email : <strong>{{$customerEmail}} </strong> </p>
            </div>
            <div class="summary-total">
                <div class="total-title">Total</div>
                <div class="total-value final-value" id="basket-total">{{number_format($cartTotal)}}</div>
            </div>
            <div class="summary-checkout">
                @if($canCheckOut)
                    <button class="checkout-cta btn-primary"  wire:click="checkoutCart">Purchase</button>
                @endif
                <br>
                <button class="checkout-cta btn-danger"  wire:click="proceedToCheckout">Cancel</button>
            </div>
        </div>
    </aside>
</div>
