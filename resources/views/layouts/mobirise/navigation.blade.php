<nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
    <div class="container-fluid">
        <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="/">
                        <img src="{{asset('assets/images/logo-landscape-350x53.png')}}" alt="Demyhealth" style="height: 3.6rem;">
                    </a>
                </span>

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        COVID 19
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.covid-19-pcr-testing')}}">
                            Covid-19 PCR Test
                        </a>
                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.covid-19-rapid-antigen-testing')}}">
                            Covid-19 Rapid Antigen Test
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-bs-auto-close="outside" aria-expanded="false" data-toggle="dropdown-submenu" data-bs-toggle="dropdown">
                        Lab Tests
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.take-a-test')}}" data-bs-auto-close="outside" aria-expanded="false">
                            Take a test
                        </a>
                        <a class="text-black dropdown-item display-4" href="{{route('frontend.upcoming-test-bookings')}}" data-bs-auto-close="outside" aria-expanded="false">
                            Test  Bookings
                        </a>
                        <a class="text-black dropdown-item display-4" href="{{route('frontend.test-results')}}" data-bs-auto-close="outside" aria-expanded="false">
                            Test Results
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-bs-auto-close="outside" aria-expanded="false" data-toggle="dropdown-submenu" data-bs-toggle="dropdown">
                        Our Business Units
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined" data-bs-popper="none">
                        <div class="dropdown">
                            <a class="text-black dropdown-item dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Our Products
                            </a>
                            <div class="dropdown-menu dropdown-submenu" aria-labelledby="dropdown-undefined" data-bs-popper="none">
                                <div class="dropdown">
                                    <a class="text-black dropdown-item dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        Medical Devices
                                    </a>
                                    <div class="dropdown-menu dropdown-submenu" aria-labelledby="dropdown-undefined">
                                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.business-units.products.medical-devices.pcr-and-reagents')}}">
                                            PCR &amp; Reagents
                                        </a>
                                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.business-units.products.medical-devices.hospital-and-laboratory-products')}}">
                                            Hospital and Laboratory products
                                        </a>
                                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.business-units.products.medical-devices.pharmaceuticals.html')}}">
                                            Pharmaceuticals
                                        </a>
                                    </div>
                                </div>
{{--                                <a class="text-black dropdown-item text-primary display-4" href="procurement-and-supply.html">Procurement--}}
{{--                                    and Supply</a>--}}
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="text-black dropdown-item dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                Our Services
                            </a>
                            <div class="dropdown-menu dropdown-submenu" aria-labelledby="dropdown-undefined">
                                <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.business-units.services.pcr-diag-research')}}">
                                    PCR testing, diagnostics and research
                                </a>
                                <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.business-units.services.biomedical-engineering')}}">
                                    Biomedical Engineering
                                </a>
                                <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.business-units.services.sequencing-and-biorepository-services')}}">
                                    Sequencing and Biorepository Services
                                </a>
                                <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.business-units.services.molecular-biology-training')}}">
                                    Molecular Biology Training
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black text-primary display-4" href="{{route('frontend.business-units.products.medical-devices.pcr-and-reagents')}}">
                        PCR &amp; Reagents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="{{route('frontend.set-up-your-lab')}}" data-bs-auto-close="outside" aria-expanded="false">
                        Set up your lab
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        About us
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.about.about-us')}}">About Us</a>
                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.about.our-team')}}">Our Team</a>
                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.about.mission-statement')}}">Mission Statement</a>
                        <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.contact')}}">Contact</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="{{route('frontend.blog-posts.index')}}" data-bs-auto-close="outside" aria-expanded="false">
                        Blog
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        @auth
                            @if(auth()->user()->hasPermissionTo('backend'))
                                <a class="text-black dropdown-item text-primary display-4" href="{{url('admin')}}">Admin Section</a>
                            @else
                                <a class="text-black dropdown-item text-primary display-4" href="{{url('admin')}}">My Account</a>
                                <a class="text-black dropdown-item text-primary display-4" href="{{url('admin/my-test-results')}}">My Results</a>
                            @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                                           class="text-black dropdown-item text-primary display-4"
                                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                        @else
                            <a class="text-black dropdown-item text-primary display-4" href="{{ route('login') }}">Login<br></a>
                            @if (Route::has('register'))
                                <a class="text-black dropdown-item text-primary display-4" href="{{ route('register') }}">Register<br></a>
                            @endif
{{--                            <a class="text-black dropdown-item display-4" href="{{route('frontend.my-orders')}}" data-bs-auto-close="outside" aria-expanded="false">--}}
{{--                                My Orders--}}
{{--                            </a>--}}

                        @endauth
                    </div>

                </li>
                @if(!Cart::isEmpty())
                    <li class="nav-item dropdown">
                        <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            My Cart ({{Cart::getContent()->count()}})
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                            <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.cart.display')}}">View Cart/Checkout</a>
                            <a class="text-black dropdown-item text-primary display-4" href="{{route('frontend.cart.clear')}}">Clear Cart</a>
                        </div>
                    </li>
                @endif
            </ul>


        </div>
    </div>
</nav>
