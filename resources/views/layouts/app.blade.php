<x-layouts.base>
    {{-- If the user is authenticated --}}
    @auth()
        {{-- If the user is authenticated on the static sign up or the sign up page --}}
        @if (in_array(request()->route()->getName(),['static-sign-up', 'sign-up'],))
            @include('layouts.navbars.guest.sign-up')
            {{ $slot }}
            @include('layouts.footers.guest.with-socials')
            {{-- If the user is authenticated on the static sign in or the login page --}}
        @elseif (in_array(request()->route()->getName(),['sign-in', 'login'],))
            @include('layouts.navbars.guest.login')
            {{ $slot }}
            @include('layouts.footers.guest.description')
        @elseif (in_array(request()->route()->getName(),['profile', 'my-profile'],))
            @include('layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100">
                @include('layouts.navbars.auth.nav-profile')
                <div>
                    {{ $slot }}
                    @include('layouts.footers.auth.footer')
                </div>
            </div>
            @include('components.plugins.fixed-plugin')
        {{-- NEW BLOCK: For substation detail/edit pages and other general authenticated content --}}
        @elseif (in_array(request()->route()->getName(),['substation.show', 'substation.edit'],))
            @include('layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100"> {{-- Consider if you need main-content div here too --}}
                @include('layouts.navbars.auth.nav') {{-- Assuming this is the general auth nav --}}
                @include('components.plugins.fixed-plugin')
                <main> {{-- It's good practice to wrap main page content in <main> --}}
                    {{ $slot }} {{-- Livewire component content will be placed here --}}
                    <div class="container-fluid"> {{-- Assuming footer needs to be within container-fluid --}}
                        <div class="row">
                            @include('layouts.footers.auth.footer')
                        </div>
                    </div>
                </main>
            </div>
        @else {{-- FALLBACK FOR ANY OTHER AUTHENTICATED ROUTES NOT EXPLICITLY LISTED --}}
            @include('layouts.navbars.auth.sidebar')
            @include('layouts.navbars.auth.nav')
            @include('components.plugins.fixed-plugin')
            <main> {{-- Ensuring <main> tag is used for the slot too --}}
                {{ $slot }}
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.auth.footer')
                    </div>
                </div>
            </main>
        @endif
    @endauth

    {{-- If the user is not authenticated (if the user is a guest) --}}
    @guest
        {{-- If the user is on the login page --}}
        @if (!auth()->check() && in_array(request()->route()->getName(),['login'],))
            <div>
                @include('layouts.navbars.guest.login')
                {{ $slot }}
                @include('layouts.footers.guest.with-socials')
            </div>
        @endif
    @endguest

</x-layouts.base>