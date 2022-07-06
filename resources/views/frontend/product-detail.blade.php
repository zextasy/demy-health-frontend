<x-mobirise-layout>

    <section data-bs-version="5.1" class="info3 cid-sUiuU4aNwh" id="info3-b">
        @include('components.mobirise.title', ['title' => 'View Product', 'subTitle' => 'See the details of our product below.'])
    </section>

    <section data-bs-version="5.1" class="features8 cid-sUzTgfTEN7" xmlns="http://www.w3.org/1999/html" id="features9-d">

        <div class="container">
            <livewire:cards.product-item-detail
                :product="$product">
            </livewire:cards.product-item-detail>
        </div>
    </section>

</x-mobirise-layout>
