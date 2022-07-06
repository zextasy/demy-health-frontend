<div class="content-wrapper">
    <div class="row align-items-center">
        <div class="col-12 col-lg-6">
            <div class="image-wrapper">
                <img src="{{$imageUrl}}" alt="Product Image">
            </div>
        </div>
        <div class="col-12 col-lg">
            <div class="text-wrapper">
                <h6 class="card-title mbr-fonts-style display-5">
                    <strong>{{$title}}</strong>
                </h6>
                <p class="mbr-text mbr-fonts-style mb-4 display-4">
                    {{$description}}</p>
                <div>
                    <p class="price mbr-fonts-style display-2">{{$displayPrice}}</p>
                </div>
                <div class="mbr-section-btn mt-3">
                    <button wire:click="addToCart" class="btn btn-primary display-4">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
