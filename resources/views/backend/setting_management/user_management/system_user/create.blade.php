@extends('adminlte::page')

@section('title', 'Add System User')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/create_page/system_user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/create_page/system_user_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/create_page/system_user_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/create_page/system_user_password.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/create_page/system_user_responsive.css') }}">
@stop

@section('content_header')
    <div class="system-user-create-header">
        <div class="system-user-create-heading">
            <div class="system-user-create-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div>
                <h1>Add System User</h1>
                <p>Create a new system account and assign the appropriate access role.</p>
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
                <strong>User created successfully.</strong>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <div class="system-user-create-card">
        <form action="{{ route('system_users.store') }}" method="POST">
            @csrf

            {{-- ACCOUNT & ACCESS --}}
            <div class="system-user-form-section">
                <div class="system-user-section-header">
                    <div class="system-user-section-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <h3>Account & Access</h3>
                        <p>Set the user's role and login username.</p>
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

                            @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
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
                                id="username" name="username" value="{{ old('username') }}" autocomplete="username"
                                placeholder="Enter username">
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
                        <p>Enter the user's basic identification details.</p>
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
                                name="name" value="{{ old('name') }}" autocomplete="name"
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
                                name="email" value="{{ old('email') }}" autocomplete="email"
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
                        <p>Add the user's primary and secondary contact numbers.</p>
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
                                name="phone" value="{{ old('phone') }}" autocomplete="tel"
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
                                id="phone_2" name="phone_2" value="{{ old('phone_2') }}" autocomplete="tel"
                                placeholder="Enter secondary phone number">
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
                        <p>Create a secure password for this account.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="password">
                            Password
                            <span class="text-danger">*</span>
                        </label>

                        <div class="system-user-password-wrapper">
                            <i class="fas fa-key"></i>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" autocomplete="new-password" placeholder="Enter password">

                            <button type="button" class="system-user-password-toggle" data-target="password"
                                aria-label="Show password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password_confirmation">
                            Confirm Password
                            <span class="text-danger">*</span>
                        </label>

                        <div class="system-user-password-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                placeholder="Confirm password">

                            <button type="button" class="system-user-password-toggle"
                                data-target="password_confirmation" aria-label="Show password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="system-user-password-hint">
                    <i class="fas fa-shield-alt"></i>
                    <span>Use a strong password that contains a combination of letters, numbers and special
                        characters.</span>
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
                        <i class="fas fa-user-plus mr-1"></i>
                        Create User
                    </button>
                </div>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script>
        document.querySelectorAll('.system-user-password-toggle').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = document.getElementById(this.dataset.target);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    this.setAttribute('aria-label', 'Hide password');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    this.setAttribute('aria-label', 'Show password');
                }
            });
        });
    </script>
@stop
