<x-mobirise-layout>

    <section data-bs-version="5.1" class="info3 cid-sUzWCCBQYV" id="info3-k">
        @include('components.mobirise.title', ['title' => 'Pharmaceuticals', 'subTitle' => 'See a list of our products below.'])
    </section>

    <section data-bs-version="5.1" class="features8 cid-sUzWCDdBqG" xmlns="http://www.w3.org/1999/html" id="features9-l">

        <div class="container">
            @include('components.mobirise.single-product-display',['imageUrl'=>'assets/images/mbr-3-816x544.jpg', 'title' => 'Sample Pharmaceutical', 'description' =>'Description', 'price' => '20000' ,'buttonUrl'=>'#','buttonText' =>'Order Now'])
            @include('components.mobirise.single-product-display',['imageUrl'=>'assets/images/mbr-1-816x540.jpg', 'title' => 'Sample Pharmaceutical 2', 'description' =>'Description', 'price' => '20000' ,'buttonUrl'=>'#','buttonText' =>'Order Now'])
        </div>
    </section>

</x-mobirise-layout>

