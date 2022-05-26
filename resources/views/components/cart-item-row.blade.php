<div class="basket-product">
    <div class="item">
        <div class="product-image">
            <img src="{{asset($pictureUrl)}}" alt="Product Image" class="product-frame">
        </div>
        <div class="product-details">
            <h1><strong><span class="item-quantity">{{$quantity}}</span> x </strong>{{$itemName}}</h1>
            <p><strong>{{$model}}</strong></p>
            <p>{{$description}}</p>
        </div>
    </div>
    <div class="price">{{number_format($itemPrice)}}</div>
    <div class="quantity align-center">
        <span class="align-center">{{$quantity}}</span>
    </div>
    <div class="subtotal">{{number_format($subTotal)}}</div>
</div>
