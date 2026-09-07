@php
    $user = Auth::user();
    $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout');
    $profile_url = View::getSection('profile_url') ?? 'system_users.user_profile_show';
    $userRole = $user->getRoleNames()->first();
    $doctor = $userRole === 'doctor' ? \App\Models\Doctor::where('user_id', $user->id)->first() : null;
    $profileImage =
        $userRole === 'doctor'
            ? $doctor?->image ?? 'uploads/images/default.jpg'
            : $user->profile_picture ?? 'uploads/images/default.jpg';
    $dashboardUrl = match ($userRole) {
        'admin' => route('dashboard.admin'),
        'doctor' => route('dashboard.doctor'),
        'user' => route('dashboard.user'),
        default => '#',
    };
    $roleLabel = match ($userRole) {
        'admin' => 'Administrator',
        'doctor' => 'Doctor',
        'user' => 'Patient',
        default => ucfirst($userRole ?? 'User'),
    };
@endphp

@if (config('adminlte.usermenu_profile_url', false))
    @php($profile_url = $user->adminlte_profile_url())
@endif

@if (config('adminlte.use_route_url', false))
    @php($profile_url = $profile_url ? route($profile_url) : '')
    @php($logout_url = $logout_url ? route($logout_url) : '')
@else
    @php($profile_url = $profile_url ? url($profile_url) : '')
    @php($logout_url = $logout_url ? url($logout_url) : '')
@endif

<li class="nav-item dropdown user-menu">

    {{-- USER MENU TOGGLER --}}
    <a href="#" class="nav-link dropdown-toggle user-menu-toggle" data-toggle="dropdown">
        <span class="user-menu-avatar">
            <img src="{{ asset($profileImage) }}" alt="{{ $user->name }}">
        </span>
        <span class="user-menu-name d-none d-md-inline">
            {{ $user->name }}
        </span>
        <i class="fas fa-chevron-down user-menu-arrow"></i>
    </a>

    {{-- USER MENU DROPDOWN --}}
    <ul class="dropdown-menu dropdown-menu-right user-menu-dropdown">

        {{-- PROFILE HEADER --}}
        <li class="user-menu-profile">
            <div class="user-menu-profile-image">
                <img src="{{ asset($profileImage) }}" alt="{{ $user->name }}">
            </div>
            <div class="user-menu-profile-info">
                <strong>{{ $user->name }}</strong>
                <span>
                    <i class="fas fa-circle"></i>
                    {{ $roleLabel }}
                </span>
            </div>
        </li>

        {{-- DASHBOARD --}}
        <li class="user-menu-dashboard">
            <a href="{{ $dashboardUrl }}" class="user-menu-item">
                <span class="user-menu-item-icon dashboard-icon">
                    <i class="fas fa-th-large"></i>
                </span>
                <span class="user-menu-item-content">
                    <strong>Dashboard</strong>
                    <small>View your dashboard</small>
                </span>
                <i class="fas fa-chevron-right user-menu-item-arrow"></i>
            </a>
        </li>

        {{-- PROFILE --}}
        <li>
            <a href="{{ $profile_url ?? '#' }}" class="user-menu-item">
                <span class="user-menu-item-icon profile-icon">
                    <i class="fas fa-user"></i>
                </span>
                <span class="user-menu-item-content">
                    <strong>My Profile</strong>
                    <small>Manage your account</small>
                </span>
                <i class="fas fa-chevron-right user-menu-item-arrow"></i>
            </a>
        </li>

        {{-- DIVIDER --}}
        <li class="user-menu-divider"></li>

        {{-- LOGOUT --}}
        <li>
            <a href="#" class="user-menu-item user-menu-logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="user-menu-item-icon logout-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </span>
                <span class="user-menu-item-content">
                    <strong>Logout</strong>
                    <small>Sign out of your account</small>
                </span>
                <i class="fas fa-chevron-right user-menu-item-arrow"></i>
            </a>
        </li>

        <form id="logout-form" action="{{ $logout_url }}" method="POST" class="user-menu-logout-form">
            @if (config('adminlte.logout_method'))
                {{ method_field(config('adminlte.logout_method')) }}
            @endif
            {{ csrf_field() }}
        </form>

    </ul>

</li>
