@extends('frontend.layouts.app')
@section('title', 'My Profile - SusthoCare')
@section('content')
    @include('frontend.custom_layout.header')
    <section class="profile-header">
        <div class="container">
            <div class="profile-header-content">
                <div class="profile-header-icon"><i class="fas fa-user-circle"></i></div>
                <div>
                    <span class="profile-header-eyebrow">SusthoCare Account</span>
                    <h1>My Profile</h1>
                    <p>Manage your account information and healthcare activities.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="profile-section">
        <div class="container">
            <div class="profile-layout">
                <div class="profile-card">
                    <div class="profile-card-top">
                        <div class="profile-image-wrapper">
                            <img src="{{ asset($profileImage) }}" alt="{{ $user->name }}" class="profile-image">
                            <span class="profile-online-dot"></span>
                        </div>
                        <span class="profile-status-badge"><i class="fas fa-check-circle"></i> Active</span>
                    </div>
                    <div class="profile-card-body">
                        <h2>{{ $user->name }}</h2>
                        <p class="profile-email"><i class="fas fa-envelope"></i>{{ $user->email }}</p>
                        @if ($isAdmin)
                            <div class="profile-role admin-role"><i class="fas fa-user-shield"></i> Admin</div>
                        @elseif($isDoctor)
                            <div class="profile-role doctor-role"><i class="fas fa-user-md"></i> Doctor</div>
                        @else
                            <div class="profile-role user-role"><i class="fas fa-user"></i> Patient</div>
                        @endif
                        <div class="profile-divider"></div>
                        <div class="profile-card-footer">
                            <div class="profile-member">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <span>Account Status</span>
                                    <strong>Verified & Active</strong>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="profile-logout-btn"><i
                                        class="fas fa-sign-out-alt"></i><span>Logout</span></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="profile-info-area">
                    <div class="profile-welcome-card">
                        <div class="profile-welcome-icon">
                            @if ($isAdmin)
                                <i class="fas fa-user-shield"></i>
                            @elseif($isDoctor)
                                <i class="fas fa-user-md"></i>
                            @else
                                <i class="fas fa-heartbeat"></i>
                            @endif
                        </div>
                        <div>
                            <span>Welcome back</span>
                            <h2>{{ $user->name }}</h2>
                            <p>Your SusthoCare {{ $role }} account is ready to help you manage your healthcare
                                experience.</p>
                        </div>
                    </div>
                    <div class="profile-info-grid">
                        <div class="profile-info-card">
                            <div class="profile-info-card-header">
                                <div class="profile-info-icon"><i class="fas fa-id-card"></i></div>
                                <div>
                                    <span>Personal Information</span>
                                    <h3>Account Details</h3>
                                </div>
                            </div>
                            <div class="profile-detail-list">
                                <div class="profile-detail">
                                    <span><i class="fas fa-user"></i>Name</span>
                                    <strong>{{ $user->name }}</strong>
                                </div>
                                <div class="profile-detail">
                                    <span><i class="fas fa-envelope"></i>Email</span>
                                    <strong>{{ $user->email }}</strong>
                                </div>
                                <div class="profile-detail">
                                    <span><i class="fas fa-user-tag"></i>Account Type</span>
                                    <strong>{{ ucfirst($role) }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="profile-info-card">
                            <div class="profile-info-card-header">
                                <div class="profile-info-icon"><i class="fas fa-bolt"></i></div>
                                <div>
                                    <span>Healthcare Access</span>
                                    <h3>Quick Actions</h3>
                                </div>
                            </div>
                            <div class="profile-action-list">
                                @if (!$isAdmin)
                                    <a href="{{ route('appointment') }}" class="profile-action">
                                        <span class="profile-action-icon"><i class="fas fa-calendar-plus"></i></span>
                                        <span><strong>Book Appointment</strong><small>Schedule your next
                                                visit</small></span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                    <a href="{{ route('doctor') }}" class="profile-action">
                                        <span class="profile-action-icon"><i class="fas fa-user-md"></i></span>
                                        <span><strong>Find Doctors</strong><small>Explore healthcare
                                                specialists</small></span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                    <a href="{{ route('service') }}" class="profile-action">
                                        <span class="profile-action-icon"><i class="fas fa-stethoscope"></i></span>
                                        <span><strong>Healthcare Services</strong><small>Explore available
                                                services</small></span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <div class="profile-admin-message">
                                        <span class="profile-action-icon"><i class="fas fa-cogs"></i></span>
                                        <span><strong>Administration Account</strong><small>Use the dashboard to manage
                                                SusthoCare.</small></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="profile-security-card">
                        <div class="profile-security-icon"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <span>Account Security</span>
                            <h3>Your account is active</h3>
                            <p>Your SusthoCare {{ $role }} account is currently verified and ready to use.</p>
                        </div>
                        <div class="profile-security-badge"><i class="fas fa-check"></i> Secure</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.custom_layout.footer')
@endsection
