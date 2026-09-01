@extends('adminlte::page')

@section('title', 'Edit User Profile')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_page_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_inputs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_password.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_responsive.css') }}">
@stop

@section('content_header')
    <div class="profile-edit-page-header">
        <div class="profile-edit-header-content">
            <div class="profile-edit-header-icon">
                <i class="fas fa-user-edit"></i>
            </div>

            <div class="profile-edit-header-title">
                <h1>Edit Profile</h1>
                <p>Update your personal and account information</p>
            </div>
        </div>

        <a href="{{ route('system_users.user_profile_show') }}" class="btn btn-light profile-edit-back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Profile
        </a>
    </div>
@stop

@section('content')
    <div class="profile-edit-card">
        <div class="profile-edit-card-header">
            <div class="profile-edit-card-title">
                <div class="profile-edit-card-title-icon">
                    <i class="fas fa-user-cog"></i>
                </div>

                <div>
                    <h4>Account Settings</h4>
                    <small>Manage your profile information securely</small>
                </div>
            </div>
        </div>

        <div class="profile-edit-card-body">
            @if ($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <strong>
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Please check the following:
                    </strong>

                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('system_users.user_profile_update') }}" method="POST" enctype="multipart/form-data"
                id="profileUpdateForm">
                @csrf
                @method('PUT')

                {{-- PERSONAL INFORMATION --}}
                <div class="profile-edit-section">
                    <div class="profile-edit-section-heading">
                        <div class="profile-edit-section-heading-icon">
                            <i class="fas fa-user"></i>
                        </div>

                        <div>
                            <h5>Personal Information</h5>
                            <small>Your basic account information</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="profile-edit-form-group">
                                <label for="name" class="profile-edit-form-label">
                                    <i class="fas fa-id-card"></i>
                                    Full Name
                                </label>

                                <input type="text" name="name" id="name"
                                    class="form-control profile-edit-form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" placeholder="Enter your full name">

                                @error('name')
                                    <span class="profile-edit-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-edit-form-group">
                                <label for="username" class="profile-edit-form-label">
                                    <i class="fas fa-at"></i>
                                    Username
                                </label>

                                <input type="text" name="username" id="username"
                                    class="form-control profile-edit-form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username) }}" placeholder="Enter username">

                                @error('username')
                                    <span class="profile-edit-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-edit-form-group">
                                <label for="email" class="profile-edit-form-label">
                                    <i class="fas fa-envelope"></i>
                                    Email Address
                                </label>

                                <input type="email" name="email" id="email"
                                    class="form-control profile-edit-form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" placeholder="Enter email address">

                                @error('email')
                                    <span class="profile-edit-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-edit-form-group">
                                <label for="phone" class="profile-edit-form-label">
                                    <i class="fas fa-phone"></i>
                                    Phone
                                </label>

                                <input type="text" name="phone" id="phone"
                                    class="form-control profile-edit-form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">

                                @error('phone')
                                    <span class="profile-edit-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-edit-form-group">
                                <label for="phone_2" class="profile-edit-form-label">
                                    <i class="fas fa-phone-alt"></i>
                                    Secondary Phone
                                </label>

                                <input type="text" name="phone_2" id="phone_2"
                                    class="form-control profile-edit-form-control @error('phone_2') is-invalid @enderror"
                                    value="{{ old('phone_2', $user->phone_2) }}" placeholder="Enter secondary phone">

                                @error('phone_2')
                                    <span class="profile-edit-invalid">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="profile-edit-form-group">
                                <label for="profile_picture" class="profile-edit-form-label">
                                    <i class="fas fa-camera"></i>
                                    Profile Picture
                                </label>

                                <input type="file" name="profile_picture" id="profile_picture"
                                    class="form-control profile-edit-form-control profile-edit-file @error('profile_picture') is-invalid @enderror"
                                    accept="image/jpeg,image/png,image/jpg,image/gif">

                                @error('profile_picture')
                                    <span class="profile-edit-invalid">{{ $message }}</span>
                                @enderror

                                @if ($user->profile_picture)
                                    <div class="profile-edit-current-image">
                                        <img src="{{ asset($user->profile_picture) }}" alt="Current Profile Picture">
                                        <span>Current profile picture</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PASSWORD --}}
                <div class="profile-edit-section">
                    <div class="profile-password-section">
                        <div class="profile-password-heading">
                            <div class="profile-password-icon">
                                <i class="fas fa-lock"></i>
                            </div>

                            <div>
                                <h5>Change Password</h5>
                                <small>Leave these fields empty if you do not want to change it</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-edit-form-group mb-md-0">
                                    <label for="current_password" class="profile-edit-form-label">
                                        Current Password
                                    </label>

                                    <div class="profile-password-input">
                                        <input type="password" name="current_password" id="current_password"
                                            class="form-control profile-edit-form-control @error('current_password') is-invalid @enderror"
                                            placeholder="Current password">

                                        <button type="button" class="profile-password-toggle toggle-password"
                                            data-target="current_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>

                                    @error('current_password')
                                        <span class="profile-edit-invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="profile-edit-form-group mb-md-0">
                                    <label for="new_password" class="profile-edit-form-label">
                                        New Password
                                    </label>

                                    <div class="profile-password-input">
                                        <input type="password" name="new_password" id="new_password"
                                            class="form-control profile-edit-form-control @error('new_password') is-invalid @enderror"
                                            placeholder="New password">

                                        <button type="button" class="profile-password-toggle toggle-password"
                                            data-target="new_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>

                                    @error('new_password')
                                        <span class="profile-edit-invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="profile-edit-form-group mb-0">
                                    <label for="confirm_password" class="profile-edit-form-label">
                                        Confirm Password
                                    </label>

                                    <div class="profile-password-input">
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="form-control profile-edit-form-control @error('confirm_password') is-invalid @enderror"
                                            placeholder="Confirm password">

                                        <button type="button" class="profile-password-toggle toggle-password"
                                            data-target="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>

                                    @error('confirm_password')
                                        <span class="profile-edit-invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="profile-password-note">
                            <i class="fas fa-info-circle"></i>
                            <span>
                                Your current password is required whenever you want to change
                                your password.
                            </span>
                        </div>
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="profile-edit-footer">
                    <div class="profile-edit-footer-left">
                        <i class="fas fa-shield-alt"></i>
                        Your account information is securely protected.
                    </div>

                    <div class="profile-edit-actions">
                        <a href="{{ route('system_users.user_profile_show') }}" class="btn btn-light profile-edit-cancel-btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary profile-edit-save-btn">
                            <i class="fas fa-save"></i>
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
