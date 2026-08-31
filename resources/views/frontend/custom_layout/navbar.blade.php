<nav class="navbar navbar-expand-lg premium-navbar sticky-header">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('welcome') }}">
            <img src="{{ asset('uploads/images/original_logor.JPG') }}" class="brand-logo">
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            ☰
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navMenu">
            <ul class="navbar-nav nav-pill">
                <li>
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}"
                        href="{{ route('welcome') }}">
                        Home
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ request()->routeIs('doctor') ? 'active' : '' }}" href="{{ route('doctor') }}">
                        Doctors
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ request()->routeIs('service') ? 'active' : '' }}"
                        href="{{ route('service') }}">
                        Services
                    </a>
                </li>

                <li>
                    <a class="nav-link {{ request()->routeIs('appointment') ? 'active' : '' }}"
                        href="{{ route('appointment') }}">
                        Appointments
                    </a>
                </li>
          
                <li>
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        Contact
                    </a>
                </li>
            </ul>
        </div>

        @php
            $user = auth()->user();

            // DEFAULT ROUTE
            $dashboardRoute = 'dashboard.user';

            if ($user) {
                if ($user->hasRole('admin')) {
                    $dashboardRoute = 'dashboard.admin';
                } elseif ($user->hasRole('doctor')) {
                    $dashboardRoute = 'dashboard.doctor';
                }
            }
        @endphp

        <div class="nav-actions d-flex align-items-center gap-2">
            @auth
                <div class="dropdown">
                    <button class="btn btn-light border dropdown-toggle d-flex align-items-center gap-2" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                        <span class="fw-semibold">
                            {{ auth()->user()->name }}
                        </span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2">
                        {{-- ================= PUBLIC ================= --}}
                        <li class="px-2 py-1 text-muted small">
                            🌐 Public Area
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.profile') }}">
                                👤 My Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        {{-- ================= DASHBOARD ================= --}}
                        <li class="px-2 py-1 text-muted small">
                            ⚙️ Dashboard Area
                        </li>

                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center"
                                href="{{ route($dashboardRoute) }}">
                                <span>📊 Dashboard</span>
                                @if ($user->hasRole('admin'))
                                    <span class="badge bg-danger">Admin</span>
                                @elseif ($user->hasRole('doctor'))
                                    <span class="badge bg-primary">Doctor</span>
                                @else
                                    <span class="badge bg-success">User</span>
                                @endif
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">

                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-success">
                    Login
                </a>
                <a class="nav-link {{ request()->routeIs('search.data') ? 'active' : '' }}"
                    href="{{ route('search.data') }}">
                    <i class="fas fa-search mr-1"></i>
                    Search
                </a>
            @endguest
        </div>
    </div>
</nav>
