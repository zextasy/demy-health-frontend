<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v5.5.8, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/images/whatsapp-image-2021-12-17-at-14.30.08-96x29.jpg')}}" type="image/x-icon">
    <meta name="description" content="">


    <title>DemyHealth</title>
    <!-- Tailwind -->
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
    <!-- Mobirise Styles -->
    <link rel="stylesheet" href="{{asset('assets/web/assets/mobirise-icons2/mobirise2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/parallax/jarallax.css')}}">
    <link rel="stylesheet" href="{{asset('assets/animatecss/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dropdown/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/socicon/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theme/css/style.css')}}">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
    </noscript>
    <link rel="preload" as="style" href="{{asset('assets/mobirise/css/mbr-additional.css')}}">
    <link rel="stylesheet" href="{{asset('assets/mobirise/css/mbr-additional.css')}}" type="text/css">
    <!-- Select2 -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Laravel Styles -->
    @vite('resources/css/app.css')
    @livewireStyles
    @vite('resources/js/app.js')
    <!-- My Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    @stack('styles')
</head>
<body>
@include('sweetalert::alert')
<section data-bs-version="5.1" class="menu menu1 cid-sTd3LiLcWy" once="menu" id="menu1-0">

    @include('layouts.mobirise.navigation')
</section>
<section>
    {{-- extra - flash, etc--}}
</section>
<!-- Page Content -->
<main>
    {{ $slot }}
</main>

<!-- X- Page Content -->
<!-- Page Footer -->
<section data-bs-version="5.1" class="footer6 cid-sTd5nEsUE7 mbr-parallax-background" once="footers" id="footer6-7">

    @include('layouts.mobirise.footer')
</section>
<!-- X Page Footer -->
<!-- MobiriseLayout Ad -->
<section style="background-color: #fff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: flex;">
    <a href="#" style="flex: 1 1; height: 3rem; padding-left: 1rem;"></a>
    <p style="flex: 0 0 auto; margin:0; padding-right:1rem;"><a href="#" style="color:#aaa;">Zedia</a> Kaizen</p>
</section>
<!-- X MobiriseLayout Ad -->
<!-- Page Scripts -->
<script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/parallax/jarallax.js')}}"></script>
<script src="{{asset('assets/smoothscroll/smooth-scroll.js')}}"></script>
<script src="{{asset('assets/ytplayer/index.js')}}"></script>
<script src="{{asset('assets/dropdown/js/navbar-dropdown.js')}}"></script>
{{--<script src="{{asset('assets/theme/js/script.js')}}"></script>--}}{{-- TODO currently causing issues, needed--}}
{{--<script src="{{asset('assets/formoid/formoid.min.js')}}"></script>--}}{{-- used for forms, not needed--}}
<script src="{{asset('assets/embla/embla.min.js')}}"></script>
<script src="{{asset('assets/embla/script.js')}}"></script>

{{--<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="assets/parallax/jarallax.js"></script>--}}
{{--<script src="assets/smoothscroll/smooth-scroll.js"></script>--}}
{{--<script src="assets/ytplayer/index.js"></script>--}}
{{--<script src="assets/dropdown/js/navbar-dropdown.js"></script>--}}
{{--<script src="assets/theme/js/script.js"></script>--}}
{{--<script src="assets/formoid/formoid.min.js"></script>--}}
{{--<script src="assets/embla/embla.min.js"></script>--}}
{{--<script src="assets/embla/script.js"></script>--}}
<!-- X Page Scripts -->

<input name="animation" type="hidden">
<!-- Laravel Scripts -->
@livewireScriptConfig
<!-- sweet alert scripts -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts/>
@stack('scripts')
</body>
</html>
