@extends('auth.layouts.auth-layout')

@section('auth_content')
    <div class="login-header">
        <div class="login-badge">
            <i class="fas fa-user-plus"></i>
            Create Account
        </div>

        <h2>Join SusthoCare</h2>

        <p>
            Create your healthcare account to book appointments,
            consult doctors and access digital healthcare services.
        </p>

    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Full Name -->
        <div class="input-group-custom">
            <label>Full Name</label>
            <div class="input-wrapper">
                <i class="fas fa-user"></i>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" autofocus>
            </div>

            @error('name')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        <!-- Phone -->
        <div class="input-group-custom">
            <label>Phone Number</label>
            <div class="input-wrapper">
                <i class="fas fa-phone-alt"></i>
                <input type="text" name="phone_1" value="{{ old('phone_1') }}" placeholder="Enter your phone number">
            </div>

            @error('phone_1')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="input-group-custom">
            <label>Email Address</label>
            <div class="input-wrapper">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address">
            </div>

            @error('email')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="input-group-custom">
            <label>Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Create a password">
            </div>

            @error('password')
                <small class="error-text">{{ $message }}</small>
            @enderror
        </div>

        <div class="input-group-custom">
            <label>Confirm Password</label>
            <div class="input-wrapper">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Confirm your password">
            </div>
        </div>

        <div class="login-options">
            <label class="remember-box">
                <input type="checkbox">
                <span>
                    I agree to the terms & privacy policy
                </span>
            </label>
        </div>

        <button type="submit" class="login-btn">
            <i class="fas fa-user-plus me-2"></i>
            Create Account
        </button>

    </form>

    <div class="login-footer">
        <p>
            Already have an account?
            <a href="{{ route('login') }}" class="footer-link">
                Login Here
            </a>
        </p>
    </div>
@endsection
