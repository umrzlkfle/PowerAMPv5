<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
    <div class="container">
        <a class="navbar-brand d-flex flex-column font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ route('dashboard') }}">
            PowerAMP
            <span>Underground Cables Specialised Dashboard</span>
        </a>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto">
                @if (auth()->user())
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center me-2 active" aria-current="page"
                            href="{{ route('dashboard') }}">
                            <i class="fa fa-chart-pie opacity-6  me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white me-2" href="{{ route('profile') }}">
                            <i class="fa fa-user opacity-6  me-1"></i>
                            Profile
                        </a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                    <a href="{{ auth()->user() ? route('sign-in') : route('login') }}"
                        class="btn btn-sm btn-round mb-0 me-1 bg-gradient-light" target="_blank">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
