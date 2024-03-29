<div>
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
            <div class="summary-total-items"><span class="total-items"></span>Items in your Cart</div>
            <div class="summary-subtotal">
                <div class="subtotal-title">Subtotal</div>
                <div class="subtotal-value final-value" id="basket-subtotal">{{number_format($cartSubTotal)}}</div>
                <div class="summary-promo hide">
                    <div class="promo-title">Promotion</div>
                    <div class="promo-value final-value" id="basket-promo"></div>
                </div>
            </div>
            <div class="summary-delivery">
                <label for="payment-method">Choose Payment Method</label>
                <select wire:model="paymentMethod" id="payment-method" class="summary-delivery-selection">
                    <option value="">
                        Please select
                    </option>
                    <option value="{{\App\Enums\Finance\Payments\PaymentMethodEnum::PAYSTACK->value}}">
                        PAYSTACK
                    </option>
                    <option value="{{\App\Enums\Finance\Payments\PaymentMethodEnum::OTHER->value}}">
                        Book and Pay on arrival
                    </option>
                    <option value="{{\App\Enums\Finance\Payments\PaymentMethodEnum::BANK_TRANSFER->value}}">
                        Bank Transfer
                    </option>
                </select>
            </div>
            <div class="summary-delivery">
                <label for="customer-email">Customer email</label>
                <input wire:model="customerEmail" id="customer-email" type="text" required>
                @error('customerEmail') <span class="alert-danger">{{ $message }}</span> @enderror
            </div>
            <div class="summary-total">
                <div class="total-title">Total</div>
                <div class="total-value final-value" id="basket-total">{{number_format($cartTotal)}}</div>
            </div>
            <div class="summary-checkout">
                <button class="checkout-cta"  wire:click="proceedToCheckout">Checkout</button>
            </div>
        </div>
    </aside>
</div>
