<nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
    <div class="container-fluid">
        <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="/">
                        <img src="assets/images/logo-landscape-350x53.png" alt="Demyhealth" style="height: 3.6rem;">
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
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">COVID
                        19</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        <a class="text-black dropdown-item text-primary display-4" href="covid19-pcr-testing.html">Covid-19
                            PCR
                            Test</a><a class="text-black dropdown-item text-primary display-4" href="covid19-pcr-testing.html">Covid-19
                            Rapid Antigen Test</a></div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-bs-auto-close="outside" aria-expanded="false" data-toggle="dropdown-submenu" data-bs-toggle="dropdown">Lab
                        Tests</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        <a class="text-black show dropdown-item text-primary display-4" href="take-a-test.html" data-bs-auto-close="outside" aria-expanded="false">Take
                            a
                            test</a><a class="text-black show dropdown-item display-4" href="test-results.html" data-bs-auto-close="outside" aria-expanded="false">Test
                            Results</a></div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle show display-4" href="#" data-bs-auto-close="outside" aria-expanded="false" data-toggle="dropdown-submenu" data-bs-toggle="dropdown">Our
                        Business Units</a>
                    <div class="dropdown-menu show" aria-labelledby="dropdown-undefined" data-bs-popper="none">
                        <div class="dropdown">
                            <a class="text-black dropdown-item dropdown-toggle show display-4" href="all-products.html" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Our
                                Products</a>
                            <div class="dropdown-menu dropdown-submenu show" aria-labelledby="dropdown-undefined" data-bs-popper="none">
                                <div class="dropdown">
                                    <a class="text-black dropdown-item dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Medical
                                        Devices</a>
                                    <div class="dropdown-menu dropdown-submenu" aria-labelledby="dropdown-undefined">
                                        <a class="text-black show dropdown-item text-primary display-4" href="pcr-and-reagents.html">PCR
                                            &amp;
                                            Reagents</a><a class="text-black show dropdown-item text-primary display-4" href="hospital-and-laboratory-products.html">Hospital
                                            and Laboratory
                                            products</a><a class="text-black show dropdown-item text-primary display-4" href="pharmaceuticals.html">Pharmaceuticals</a>
                                    </div>
                                </div>
{{--                                <a class="text-black dropdown-item show text-primary display-4" href="procurement-and-supply.html">Procurement--}}
{{--                                    and Supply</a>--}}
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="text-black dropdown-item dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Our
                                Services</a>
                            <div class="dropdown-menu dropdown-submenu" aria-labelledby="dropdown-undefined">
                                <a class="text-black show dropdown-item text-primary display-4" href="pcr-diag-research.html">PCR
                                    testing, diagnostics and
                                    research</a><a class="text-black show dropdown-item text-primary display-4" href="biomedical-engineering.html">Biomedical
                                    Engineering</a><a class="text-black show dropdown-item text-primary display-4" href="sequencing-and-biorepository-services.html">Sequencing
                                    and Biorepository
                                    Services</a><a class="text-black show dropdown-item text-primary display-4" href="molecular-biology-training.html">Molecular
                                    Biology Training</a></div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black text-primary display-4" href="pcr-and-reagents.html">PCR
                        &amp; Reagents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black show display-4" href="set-up-your-lab.html" data-bs-auto-close="outside" aria-expanded="false">Set
                        up your lab</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        About us</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        <a class="text-black dropdown-item text-primary display-4" href="AboutUs.html">About Us<br></a>
                        <a class="text-black dropdown-item text-primary display-4" href="OurTeam.html">Our Team</a>
                        <a class="text-black dropdown-item text-primary display-4" href="missionstatement.html">Mission Statement</a>
                        <a class="text-black dropdown-item text-primary display-4" href="Contact.html">Contact</a>
                    </div>

                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link link text-black dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        My Account</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown-undefined">
                        @auth
                            @if(auth()->user()->hasPermissionTo('backend'))
                                <a class="text-black dropdown-item text-primary display-4" href="/admin">Admin Section</a>
                            @endif
                            <a class="text-black dropdown-item text-primary display-4" href="#">My Cart</a>
                            <a class="text-black dropdown-item text-primary display-4" href="#">My Results</a>
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
                        @endauth
                    </div>

                </li>

            </ul>


        </div>
    </div>
</nav>
