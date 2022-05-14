<div class="basket-product">
    <div class="item">
        <div class="product-image">
            <img src="{{asset($pictureUrl)}}" alt="Product Image" class="product-frame">
        </div>
        <div class="product-details">
            <h1><strong><span class="item-quantity">{{$initialQuantity}}</span> x </strong>{{$itemName}}</h1>
            <p><strong>{{$model}}</strong></p>
            <p>{{$description}}</p>
        </div>
    </div>
    <div class="price">{{number_format($itemPrice)}}</div>
    <div class="quantity">
        <input type="number" inputmode="numeric" wire:model="updatedQuantity" wire:change="itemQuantityUpdated" value="{{$initialQuantity}}" min="1" class="quantity-field">
    </div>
    <div class="subtotal">{{number_format($subTotal)}}</div>
    {{--           TODO  should be subtotal--}}
    <div class="remove">
        <button onclick="return confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="itemDeleted">Remove</button>
    </div>
</div>
