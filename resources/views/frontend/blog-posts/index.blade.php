<x-mobirise-layout>
    <section data-bs-version="5.1" class="info3 cid-sUiuU4aNwh" id="info3-b">
        @include('components.mobirise.title', ['title' => 'Our Blog', 'subTitle' => 'See a list of our blog posts below.'])

    </section>

<x-mobirise.blocks.blog-list :blogPosts="$blogPosts">

</x-mobirise.blocks.blog-list>
</x-mobirise-layout>


