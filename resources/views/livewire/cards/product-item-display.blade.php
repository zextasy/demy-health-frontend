<div class="card">
    <div class="card-wrapper">
        <div class="row align-items-center">
            <div class="col-12 col-md-4">
                <div class="image-wrapper">
                    <a href="#"><img src="{{$imageUrl}}" alt="Product image"></a>
                </div>
            </div>
            <div class="col-12 col-md">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md">
                            <h6 class="card-title mbr-fonts-style display-5"><strong>{{$title}}</strong></h6>
                            <p class="mbr-text mbr-fonts-style display-7">{{$description}}</p>
                        </div>
                        <div class="col-md-auto">
                            <p class="price mbr-fonts-style display-2">{{$displayPrice}}</p>
                            <div class="mbr-section-btn">
                                <button wire:click="showProduct" class="btn btn-primary display-4">
                                    View Product
                                </button>
                                <button wire:click="addToCart" class="btn btn-primary display-4">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
