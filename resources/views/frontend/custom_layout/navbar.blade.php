<nav class="navbar navbar-expand-lg premium-navbar sticky-header">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('uploads/images/original_logor.JPG') }}" class="brand-logo" alt="Logo">
        </a>
        <button class="navbar-toggler premium-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-line"></span>
            <span class="toggler-line"></span>
            <span class="toggler-line"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navMenu">
            <ul class="navbar-nav nav-pill">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}"
                        href="{{ route('welcome') }}">
                        <i class="fas fa-home nav-icon"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('doctor') ? 'active' : '' }}" href="{{ route('doctor') }}">
                        <i class="fas fa-user-md nav-icon"></i>
                        <span>Doctors</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('service') ? 'active' : '' }}"
                        href="{{ route('service') }}">
                        <i class="fas fa-stethoscope nav-icon"></i>
                        <span>Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('appointment') ? 'active' : '' }}"
                        href="{{ route('appointment') }}">
                        <i class="fas fa-calendar-check nav-icon"></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        <i class="fas fa-envelope nav-icon"></i>
                        <span>Contact</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="nav-actions">
            <a class="nav-search-link {{ request()->routeIs('search.data') ? 'active' : '' }}"
                href="{{ route('search.data') }}">
                <span class="nav-search-icon">
                    <i class="fas fa-search"></i>
                </span>
                <span>Search</span>
            </a>
            @auth
                <div class="dropdown">
                    <button class="user-menu-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="user-menu-avatar">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="user-menu-name">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down user-menu-arrow"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end premium-dropdown">
                        <li class="dropdown-profile">
                            <div class="dropdown-profile-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="dropdown-profile-info">
                                <strong>{{ auth()->user()->name }}</strong>
                                <small>{{ auth()->user()->email }}</small>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-section-label">
                            <i class="fas fa-globe"></i>
                            <span>Public Area</span>
                        </li>
                        <li>
                            <a class="dropdown-item premium-dropdown-item" href="{{ route('frontend.profile') }}">
                                <span class="dropdown-item-icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span>My Profile</span>
                                <i class="fas fa-chevron-right dropdown-item-arrow"></i>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-section-label">
                            <i class="fas fa-th-large"></i>
                            <span>Dashboard Area</span>
                        </li>
                        <li>
                            <a class="dropdown-item premium-dropdown-item" href="{{ route($dashboardRoute) }}">
                                <span class="dropdown-item-icon">
                                    <i class="fas fa-chart-line"></i>
                                </span>
                                <span>Dashboard</span>
                                @if (auth()->user()->hasRole('admin'))
                                    <span class="user-role-badge admin-badge">Admin</span>
                                @elseif (auth()->user()->hasRole('doctor'))
                                    <span class="user-role-badge doctor-badge">Doctor</span>
                                @else
                                    <span class="user-role-badge user-badge">User</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item premium-dropdown-item logout-item">
                                    <span class="dropdown-item-icon">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="login-button">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
            @endguest
        </div>
    </div>
</nav>
