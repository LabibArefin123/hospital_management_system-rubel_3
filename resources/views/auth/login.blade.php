@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/glass.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-brand.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form_input/form-input-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form_input/form-input-field.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form_input/form-input-password.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form_input/form-input-error.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form_input/form-input-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-logo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-login-header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/responsive.css') }}">

    <div class="login-page">

        <div class="bg-overlay"></div>

        <div class="login-container">
            <!-- LEFT SIDE -->
            <div class="brand-side">
                <div class="brand-content">
                    <a href="{{ route('welcome') }}" class="brand-logo-wrapper">
                        <img src="{{ asset('uploads/images/original_logor.JPG') }}" class="brand-logo"
                            alt="SusthoCare Logo">
                    </a>

                    <!-- Text -->
                    <div class="brand-main">
                        <div class="welcome-badge"> Trusted Digital Healthcare</div>
                        <h1 class="brand-title"> Welcome to <br>SusthoCare</h1>

                        <p class="brand-subtitle">
                            Book appointments, consult doctors,
                            and manage your healthcare services
                            easily from anywhere.
                        </p>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="login-side">
                <div class="login-card">
                    <div class="login-header">
                        <div class="login-badge">
                            <i class="fas fa-user"></i>
                            Login Account
                        </div>
                        <h2>Welcome Back</h2>
                        <p>Sign in to continue your healthcare journey. </p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group-custom">
                            <label>Email or Username</label>

                            <div class="input-wrapper">
                                <i class="fas fa-user"></i>

                                <input type="text" name="login" placeholder="Enter your email or username"
                                    value="{{ old('login') }}">
                            </div>

                            @error('login')
                                <small class="error-text">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="input-group-custom">
                            <label>Password</label>

                            <div class="input-wrapper password-wrapper">
                                <i class="fas fa-lock"></i>

                                <input type="password" name="password" id="loginPassword" placeholder="Enter your password">

                                <button type="button" class="password-toggle" id="passwordToggle"
                                    aria-label="Show password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            @error('password')
                                <small class="error-text">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="login-options">
                            <label class="remember-box">
                                <input type="checkbox" name="remember">
                                <span>Remember Me</span>
                            </label>

                            <a href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>
                        </div>

                        <button type="submit" class="login-btn">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
