<x-mobirise-layout>

    <section data-bs-version="5.1" class="info3 cid-sUiuU4aNwh" id="info3-b">
        @include('components.mobirise.title', ['title' => 'Our Products', 'subTitle' => 'See a list of our products below.'])
    </section>

    <section data-bs-version="5.1" class="features8 cid-sUzTgfTEN7" xmlns="http://www.w3.org/1999/html" id="features9-d">

        <div class="container">
            @foreach($products as $product)
                @include('components.mobirise.single-product-display',['imageUrl'=>"$product->latest_picture_url", 'title' => $product->name, 'description' =>$product->description, 'price' => $product->price ,'buttonUrl'=>'#','buttonText' =>'Order Now'])
            @endforeach

        </div>
    </section>

</x-mobirise-layout>


