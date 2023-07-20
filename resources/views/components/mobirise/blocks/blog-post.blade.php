<!--  article title-->
<section data-bs-version="5.1" class="content4 cid-tKxfwOkCRw" id="content4-i">


    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>{{$blogPost->title}}</strong>
                </h3>
                <h4 class="mbr-section-subtitle align-center mbr-fonts-style mb-4 display-5">
{{--                    find subtitle content if necessary--}}
                </h4>

            </div>
        </div>
    </div>
</section>

<!--  article content-->
<section data-bs-version="5.1" class="content5 cid-tKxgEmMLoP" id="content5-j">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">


                <p class="mbr-text mbr-fonts-style display-7">
                {!! $blogPost->content !!}
            </div>
            <br>
        </div>
        <br>
    </div>
    <br>
</section>
