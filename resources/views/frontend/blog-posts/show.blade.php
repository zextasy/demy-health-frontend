<x-mobirise-layout>
    <section data-bs-version="5.1" class="info3 cid-sUiuU4aNwh" id="info3-b">
        @include('components.mobirise.title', ['title' => 'View Blog Post', 'subTitle' => 'See the details of our blog post below.'])

    </section>

    <x-mobirise.blocks.blog-post :blog-post="$blogPost"></x-mobirise.blocks.blog-post>
</x-mobirise-layout>


