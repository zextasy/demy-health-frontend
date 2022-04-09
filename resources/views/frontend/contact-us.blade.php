<x-mobirise-layout>

    <section data-bs-version="5.1" class="info3 cid-sVgRmr5pGF" id="info3-1w">
        @include('components.mobirise.title', ['title' => 'Contact us', 'subTitle' => ''])
    </section>

    <section data-bs-version="5.1" class="contacts3 map1 cid-sVgRGtoy0z" id="contacts3-20">
        <div class="container">

            <div class="row justify-content-center mt-4">
                <div class="card col-12 col-md-6">
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-phone mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Phone</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">08092776022<br>08092776065</p>
                        </div>
                    </div>
                    <div class="card-wrapper">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont mobi-mbri-globe mobi-mbri"></span>
                        </div>
                        <div class="text-wrapper">
                            <h6 class="card-title mbr-fonts-style mb-1 display-5">
                                <strong>Email</strong>
                            </h6>
                            <p class="mbr-text mbr-fonts-style display-7">care@demyhealth.com<br>lag@demyhealth.com</p>
                        </div>
                    </div>
                </div>
                <div class="map-wrapper col-12 col-md-6">
                    <div class="google-map"><iframe frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCNveGQ9bfpKFwWzQLLftrR9hNiHwdqQG8&amp;q=demyhealth building" allowfullscreen=""></iframe></div>
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="form5 cid-sVgSPxv14A" id="form5-22">
        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Get in Touch</strong></h3>

            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    @livewire('forms.get-in-touch')
                </div>
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="features8 cid-sUisQ06fKm" xmlns="http://www.w3.org/1999/html" id="features9-a">
        @include('components.mobirise.centers')
    </section>

</x-mobirise-layout>
