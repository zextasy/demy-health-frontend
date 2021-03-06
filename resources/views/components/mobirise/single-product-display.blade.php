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
                            <p class="price mbr-fonts-style display-2">NGN {{$price}}</p>
                            <div class="mbr-section-btn">
                                <a href="#" class="btn btn-primary display-4">
                                    Show
                                </a>
                                <a href="{{$buttonUrl}}" class="btn btn-primary display-4">
                                    {{$buttonText}}
                                </a>
                            </div>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
