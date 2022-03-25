<x-mobirise-layout>

    <section data-bs-version="5.1" class="info3 cid-sUzTgeDe6e" id="info3-c">
        @include('components.mobirise.title', ['title' => 'PCR & Reagents', 'subTitle' => 'See a list of our products below.'])
    </section>

    <section data-bs-version="5.1" class="features8 cid-sUzTgfTEN7" xmlns="http://www.w3.org/1999/html" id="features9-d">

        <div class="container">
            @include('components.mobirise.single-product-display',['imageUrl'=>'assets/images/mbr-816x540.jpg', 'title' => 'Sample Equipment', 'description' =>'Description', 'price' => '20000' ,'buttonUrl'=>'#','buttonText' =>'Order Now'])
            @include('components.mobirise.single-product-display',['imageUrl'=>'assets/images/mbr-816x544.jpg', 'title' => 'Sample Reagent', 'description' =>'Description', 'price' => '20000' ,'buttonUrl'=>'#','buttonText' =>'Order Now'])
        </div>

    </section>

</x-mobirise-layout>

