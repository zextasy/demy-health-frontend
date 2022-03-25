<x-mobirise-layout>

    <section data-bs-version="5.1" class="info3 cid-sUzXzq24H5" id="info3-o">
        @include('components.mobirise.title', ['title' => 'Procurement and Supply', 'subTitle' => 'See a list of our products below.'])
    </section>

    <section data-bs-version="5.1" class="features8 cid-sUzXzqZPR4" xmlns="http://www.w3.org/1999/html" id="features9-p">

        <div class="container">
            @include('components.mobirise.single-product-display',['imageUrl'=>'assets/images/mbr-4-816x544.jpg', 'title' => 'Sample Product 1', 'description' =>'Description', 'price' => '20000' ,'buttonUrl'=>'#','buttonText' =>'Order Now'])
            @include('components.mobirise.single-product-display',['imageUrl'=>'assets/images/mbr-816x519.jpg', 'title' => 'Sample Product 2', 'description' =>'Description', 'price' => '20000' ,'buttonUrl'=>'#','buttonText' =>'Order Now'])
        </div>

    </section>

</x-mobirise-layout>
