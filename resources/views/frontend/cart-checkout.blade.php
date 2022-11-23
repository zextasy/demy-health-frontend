<x-mobirise-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    @endpush
    <section data-bs-version="5.1" class="info3 cid-sVgxwvS5nT" id="info3-19">
        @include('components.mobirise.title', ['title' => 'My Cart', 'subTitle' => ''])
    </section>
    <section data-bs-version="5.1" class="features11 cid-sVgwSCAg5Y" id="features12-18">
        @livewire('pages.cart-checkout', ['customerEmail' => $customerEmail,'paymentMethod' => $paymentMethod])
    </section>

</x-mobirise-layout>


