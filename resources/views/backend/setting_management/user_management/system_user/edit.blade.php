@extends('adminlte::page')

@section('title', 'Edit System User')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/edit_page/system_user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/edit_page/system_user_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/edit_page/system_user_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/edit_page/system_user_password.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/edit_page/system_user_responsive.css') }}">
@stop

@section('content_header')
    <div class="system-user-create-header">
        <div class="system-user-create-heading">
            <div class="system-user-create-icon">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <h1>Edit System User</h1>
                <p>Update account information, contact details and access permissions.</p>
            </div>
        </div>

        <a href="{{ route('system_users.index') }}" class="btn btn-warning system-user-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Go Back</span>
        </a>
    </div>
@stop

@section('content')
    @if ($errors->any())
        <div class="system-user-alert system-user-alert-danger">
            <div class="system-user-alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <strong>Please check the form.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="system-user-alert system-user-alert-success">
            <div class="system-user-alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <strong>User updated successfully.</strong>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <div class="system-user-create-card">
        <form action="{{ route('system_users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ACCOUNT & ACCESS --}}
            <div class="system-user-form-section">
                <div class="system-user-section-header">
                    <div class="system-user-section-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <h3>Account & Access</h3>
                        <p>Manage the user's role and login credentials.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="role">
                            Assign Role
                            <span class="text-danger">*</span>
                        </label>

                        <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                            <option value="">Select Role</option>

                            @foreach (Spatie\Permission\Models\Role::all() as $role)
                                <option value="{{ $role->name }}"
                                    {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>

                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="username">
                            Username
                            <span class="text-danger">*</span>
                        </label>

                        <div class="system-user-input-wrapper">
                            <i class="fas fa-at"></i>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username', $user->username) }}"
                                autocomplete="username" placeholder="Enter username">
                        </div>

                        @error('username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- PERSONAL INFORMATION --}}
            <div class="system-user-form-section">
                <div class="system-user-section-header">
                    <div class="system-user-section-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h3>Personal Information</h3>
                        <p>Update the user's basic identification details.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">
                            Full Name
                            <span class="text-danger">*</span>
                        </label>

                        <div class="system-user-input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $user->name) }}" autocomplete="name"
                                placeholder="Enter full name">
                        </div>

                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">
                            Email Address
                            <span class="text-danger">*</span>
                        </label>

                        <div class="system-user-input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $user->email) }}" autocomplete="email"
                                placeholder="Enter email address">
                        </div>

                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- CONTACT INFORMATION --}}
            <div class="system-user-form-section">
                <div class="system-user-section-header">
                    <div class="system-user-section-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <h3>Contact Information</h3>
                        <p>Update the user's primary and secondary contact numbers.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="phone">
                            Phone
                            <span class="text-danger">*</span>
                        </label>

                        <div class="system-user-input-wrapper">
                            <i class="fas fa-phone"></i>
                            <input type="text"
                                class="form-control global-mobile-input @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone', $user->phone) }}" autocomplete="tel"
                                placeholder="Enter primary phone number">
                        </div>

                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone_2">
                            Phone 2
                            <span class="text-danger">*</span>
                        </label>

                        <div class="system-user-input-wrapper">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="text"
                                class="form-control global-mobile-input @error('phone_2') is-invalid @enderror"
                                id="phone_2" name="phone_2" value="{{ old('phone_2', $user->phone_2) }}"
                                autocomplete="tel" placeholder="Enter secondary phone number">
                        </div>

                        @error('phone_2')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- SECURITY --}}
            <div class="system-user-form-section system-user-security-section">
                <div class="system-user-section-header">
                    <div class="system-user-section-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h3>Account Security</h3>
                        <p>Password changes are managed separately from profile information.</p>
                    </div>
                </div>

                <div class="system-user-password-hint">
                    <i class="fas fa-info-circle"></i>
                    <span>
                        You do not need to enter a password here. Use the
                        <strong>Change Password</strong> action from the user management page
                        when the user's password needs to be changed.
                    </span>
                </div>
            </div>

            {{-- FORM FOOTER --}}
            <div class="system-user-form-footer">
                <div class="system-user-required-note">
                    <span class="text-danger">*</span>
                    Required fields
                </div>

                <div class="system-user-form-actions">
                    <a href="{{ route('system_users.index') }}" class="btn btn-light system-user-cancel-btn">
                        <i class="fas fa-times mr-1"></i>
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary system-user-submit-btn">
                        <i class="fas fa-save mr-1"></i>
                        Update User
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop
