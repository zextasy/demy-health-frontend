<x-mobirise-layout>
    <section data-bs-version="5.1" class="info3 cid-sUiuU4aNwh" id="info3-b">
        @include('components.mobirise.title', ['title' => 'Test Bookings', 'subTitle' => 'Submit your details and get your booking details'])

    </section>

    <section data-bs-version="5.1" class="form5 cid-sTd59uLJvm" id="form5-6">

        <div class="container">
            <div class="mbr-section-head">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                    <strong>Bookings</strong>
                </h3>

            </div>
            <div class="row justify-content-center mt-4">
                @livewire('tables.filament.list-upcoming-test-bookings', ['patient' => $patient])
            </div>
        </div>
    </section>

    <section data-bs-version="5.1" class="features8 cid-sUisQ06fKm" xmlns="http://www.w3.org/1999/html" id="features9-a">

        {{--    @include('components.mobirise.centers')--}}
    </section>

</x-mobirise-layout>


