@extends('adminlte::page')

@section('title', 'User Details Information')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/show_page/system_user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/show_page/system_user_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/show_page/system_user_profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/show_page/system_user_details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/show_page/system_user_security.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/show_page/system_user_responsive.css') }}">
@stop

@section('content_header')
    <div class="system-user-show-header">
        <div class="system-user-show-heading">
            <div class="system-user-show-icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h1>User Details</h1>
                <p>View account information, contact details and access permissions.</p>
            </div>
        </div>

        <a href="{{ route('system_users.index') }}" class="btn btn-warning system-user-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Go Back</span>
        </a>
    </div>
@stop

@section('content_header')
    <div class="system-user-create-header">
        <div class="system-user-create-heading">
            <div class="system-user-create-icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h1>User Details</h1>
                <p>View account information, contact details and access permissions.</p>
            </div>
        </div>

        <a href="{{ route('system_users.index') }}" class="btn btn-warning system-user-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Go Back</span>
        </a>
    </div>
@stop

@section('content')
    <div class="system-user-show-card">

        {{-- PROFILE HEADER --}}
        <div class="system-user-show-profile">
            <div class="system-user-show-avatar">
                @if ($user->hasRole('doctor') && $user->doctor && $user->doctor->image)
                    <img src="{{ asset($user->doctor->image) }}" alt="{{ $user->name }}">
                @elseif ($user->profile_picture)
                    <img src="{{ asset($user->profile_picture) }}" alt="{{ $user->name }}">
                @else
                    <img src="{{ asset('uploads/images/default.jpg') }}" alt="{{ $user->name }}">
                @endif
            </div>

            <div class="system-user-show-profile-info">
                <h2>{{ $user->name }}</h2>

                <div class="system-user-show-meta">
                    <span>
                        <i class="fas fa-at"></i>
                        {{ $user->username ?? 'No Username' }}
                    </span>

                    <span>
                        <i class="fas fa-envelope"></i>
                        {{ $user->email ?? 'No Email' }}
                    </span>
                </div>

                <div class="system-user-show-roles">
                    @forelse ($user->getRoleNames() as $role)
                        <span class="system-user-show-role">
                            <i class="fas fa-user-shield"></i>
                            {{ ucfirst($role) }}
                        </span>
                    @empty
                        <span class="system-user-show-role system-user-show-role-muted">
                            Not Assigned
                        </span>
                    @endforelse
                </div>
            </div>

            <div class="system-user-show-profile-action">
                <a href="{{ route('system_users.edit', $user->id) }}" class="btn btn-warning system-user-show-edit-btn">
                    <i class="fas fa-edit mr-1"></i>
                    Edit User
                </a>
            </div>
        </div>

        {{-- ACCOUNT INFORMATION --}}
        <div class="system-user-show-section">
            <div class="system-user-section-header">
                <div class="system-user-section-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <h3>Account & Access</h3>
                    <p>Login and permission information for this user.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="system-user-detail-item">
                        <span class="system-user-detail-label">
                            <i class="fas fa-user-tag"></i>
                            User Role
                        </span>
                        <span class="system-user-detail-value">
                            @forelse ($user->getRoleNames() as $role)
                                <span class="system-user-detail-role">
                                    {{ ucfirst($role) }}
                                </span>
                            @empty
                                <span class="text-muted">Not Assigned</span>
                            @endforelse
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="system-user-detail-item">
                        <span class="system-user-detail-label">
                            <i class="fas fa-at"></i>
                            Username
                        </span>
                        <span class="system-user-detail-value">
                            {{ $user->username ?? 'Not Provided' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- PERSONAL INFORMATION --}}
        <div class="system-user-show-section">
            <div class="system-user-section-header">
                <div class="system-user-section-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <h3>Personal Information</h3>
                    <p>Basic information associated with this account.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="system-user-detail-item">
                        <span class="system-user-detail-label">
                            <i class="fas fa-user"></i>
                            Full Name
                        </span>
                        <span class="system-user-detail-value">
                            {{ $user->name ?? 'Not Provided' }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="system-user-detail-item">
                        <span class="system-user-detail-label">
                            <i class="fas fa-envelope"></i>
                            Email Address
                        </span>
                        <span class="system-user-detail-value">
                            {{ $user->email ?? 'Not Provided' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTACT INFORMATION --}}
        <div class="system-user-show-section">
            <div class="system-user-section-header">
                <div class="system-user-section-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <h3>Contact Information</h3>
                    <p>Primary and secondary contact numbers.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="system-user-detail-item">
                        <span class="system-user-detail-label">
                            <i class="fas fa-phone"></i>
                            Phone
                        </span>
                        <span class="system-user-detail-value">
                            {{ $user->phone ?? 'Not Provided' }}
                        </span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="system-user-detail-item">
                        <span class="system-user-detail-label">
                            <i class="fas fa-mobile-alt"></i>
                            Phone 2
                        </span>
                        <span class="system-user-detail-value">
                            {{ $user->phone_2 ?? 'Not Provided' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECURITY INFORMATION --}}
        <div class="system-user-show-section system-user-show-security">
            <div class="system-user-section-header">
                <div class="system-user-section-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h3>Account Security</h3>
                    <p>Password information and account security.</p>
                </div>
            </div>

            <div class="system-user-security-notice">
                <div class="system-user-security-notice-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>

                <div>
                    <strong>Password Protected</strong>
                    <p>
                        The user's password is securely managed by the system.
                        For security reasons, passwords are not displayed on this page.
                    </p>
                </div>
            </div>

            @if (auth()->user()->hasRole('admin'))
                <div class="system-user-security-action">
                    <button type="button" class="btn btn-danger system-user-change-password-btn" data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal" data-user-id="{{ $user->id }}"
                        data-user-name="{{ $user->name }}" data-user-email="{{ $user->email ?? '' }}"
                        data-user-role="{{ $user->roles->pluck('name')->join(', ') }}"
                        data-user-picture="{{ $user->hasRole('doctor') && $user->doctor && $user->doctor->image
                            ? asset($user->doctor->image)
                            : ($user->profile_picture
                                ? asset($user->profile_picture)
                                : asset('uploads/images/default.jpg')) }}">
                        <i class="fas fa-key mr-1"></i>
                        Change Password
                    </button>
                </div>
            @endif
        </div>

        {{-- FOOTER --}}
        <div class="system-user-show-footer">
            <a href="{{ route('system_users.index') }}" class="btn btn-light system-user-cancel-btn">
                <i class="fas fa-arrow-left mr-1"></i>
                Back to Users
            </a>

            <a href="{{ route('system_users.edit', $user->id) }}" class="btn btn-primary system-user-submit-btn">
                <i class="fas fa-edit mr-1"></i>
                Edit User
            </a>
        </div>
    </div>

    @if (auth()->user()->hasRole('admin'))
        @include('backend.setting_management.user_management.system_user.modal.change_password')
    @endif
@stop
