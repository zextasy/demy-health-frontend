<section data-bs-version="5.1" class="content2 cid-tKxeJ3VSbQ" id="content2-h">
    <div class="container">
        <div class="mbr-section-head">
            {{--                header/title --}}
        </div>
        <div class="row mt-4">
            {{--                single item card--}}
            @foreach($blogPosts as $blogPost)
                <div class="item features-image сol-12 col-md-6 col-lg-3">
                    <div class="item-wrapper">
                        <div class="item-img">
                            <img src="{{$blogPost->banner_url}}" alt="" title="">
                        </div>
                        <div class="item-content">
                            <h5 class="item-title mbr-fonts-style display-5"><a href="{{route('frontend.blog-posts.show', $blogPost)}}" class="text-primary">{{$blogPost->title}}</a></h5>
                            <h6 class="item-subtitle mbr-fonts-style mt-1 display-7">
                                <strong>{{$blogPost->author->name}}</strong>
                                @if(isset($blogPost->published_at))
                                    <em> {{date_format($blogPost->published_at,'Y-m-d')}}</em>
                                @else
                                    <em> Unpublished</em>
                                @endif</h6>
                            {{$blogPost->public_url}}
                            <p class="mbr-text mbr-fonts-style mt-3 display-7">{{$blogPost->excerpt}}</p>
                        </div>
                        <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn item-btn btn-primary display-7" target="_blank">Read More
                                &gt;</a></div>
                    </div>
                </div>
            @endforeach
            {{--       end         single item card--}}
        </div>
    </div>
</section>
