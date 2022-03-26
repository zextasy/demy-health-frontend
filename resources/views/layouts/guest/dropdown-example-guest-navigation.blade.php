<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('covid-19-pcr-testing')" :active="request()->routeIs('covid-19-pcr-testing')">
                        {{ __('COVID-19 PCR TESTING') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link-parent :href="'#'" :active="request()->routeIs('services.*')">
                        <x-slot name="name">{{ __('Services') }}</x-slot>
                        <x-slot name="children">
                            <a href="{{route('services.all-services')}}">All Services</a>
                            <span class="separator"></span>
                            <a href="{{route('services.lab-tests')}}">Lab Tests</a>
                            <span class="separator"></span>
                            <a href="{{route('services.revolutionary-panel-testing')}}">Revolutionary Panel Testing</a>
                            <span class="separator"></span>
                            <a href="{{route('services.molecular-diagnosis')}}">Molecular Diagnosis</a>
                        </x-slot>
                    </x-nav-link-parent>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('portfolio')" :active="request()->routeIs('portfolio')">
                        {{ __('Portfolio') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link-parent :href="'#'" :active="request()->routeIs('about.*')">
                        <x-slot name="name">{{ __('About') }}</x-slot>
                        <x-slot name="children">
                            <a href="{{route('about.about-us')}}">About Us</a>
                            <span class="separator"></span>
                            <a href="{{route('about.our-team')}}">Our Team</a>
                            <span class="separator"></span>
                            <a href="{{route('about.mission-statement')}}">Mission Statement</a>
                        </x-slot>
                    </x-nav-link-parent>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('login')">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('login')">
                        {{ __('Genomic Technologies') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('covid-19-pcr-testing')" :active="request()->routeIs('dashboard')">
                {{ __('COVID-19 PCR TESTING') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link-parent :href="'#'" :active="request()->routeIs('services.*')">
                <x-slot name="name">{{ __('Services') }}</x-slot>
                <x-slot name="children">
                    <a href="{{route('services.all-services')}}">All Services</a>
                    <span class="separator"></span>
                    <a href="{{route('services.lab-tests')}}">Lab Tests</a>
                    <span class="separator"></span>
                    <a href="{{route('services.revolutionary-panel-testing')}}">Revolutionary Panel Testing</a>
                    <span class="separator"></span>
                    <a href="{{route('services.molecular-diagnosis')}}">Molecular Diagnosis</a>
                </x-slot>
            </x-responsive-nav-link-parent>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('portfolio')" :active="request()->routeIs('portfolio')">
                {{ __('Portfolio') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link-parent :href="'#'" :active="request()->routeIs('about.*')">
                <x-slot name="name">{{ __('About') }}</x-slot>
                <x-slot name="children">
                    <a href="{{route('about.about-us')}}">About Us</a>
                    <span class="separator"></span>
                    <a href="{{route('about.our-team')}}">Our Team</a>
                    <span class="separator"></span>
                    <a href="{{route('about.mission-statement')}}">Mission Statement</a>
                </x-slot>
            </x-responsive-nav-link-parent>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact Us') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('services.all-services')" :active="request()->routeIs('dashboard')">
                {{ __('Genomic Technologies') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
