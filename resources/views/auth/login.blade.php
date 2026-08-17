@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/glass.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-brand.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-input.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/login_page/form-feature.css') }}">
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

                    <!-- Logo -->
                    <a href="{{ route('welcome') }}" class="brand-logo-wrapper">

                        <img src="{{ asset('uploads/images/original_logor.JPG') }}" class="brand-logo"
                            alt="SusthoCare Logo">

                    </a>

                    <!-- Text -->
                    <div class="brand-main">

                        <div class="welcome-badge">
                            Trusted Digital Healthcare
                        </div>

                        <h1 class="brand-title">
                            Welcome to <br>
                            SusthoCare
                        </h1>

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

                    <!-- Header -->
                    <div class="login-header">
                        <div class="login-badge">
                            <i class="fas fa-user"></i>
                            Login Account
                        </div>
                        <h2>Welcome Back</h2>
                        <p>
                            Sign in to continue your healthcare journey.
                        </p>

                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <!-- Email -->
                        <div class="input-group-custom">

                            <label>Email or Username</label>

                            <div class="input-wrapper">

                                <i class="fas fa-user"></i>

                                <input type="text" name="login" placeholder="Enter your email or username" required>

                            </div>

                        </div>

                        <!-- Password -->
                        <div class="input-group-custom">

                            <label>Password</label>

                            <div class="input-wrapper">

                                <i class="fas fa-lock"></i>

                                <input type="password" name="password" placeholder="Enter your password" required>

                            </div>

                            @error('password')
                                <small class="error-text">
                                    {{ $message }}
                                </small>
                            @enderror

                        </div>

                        <!-- Options -->
                        <div class="login-options">

                            <label class="remember-box">

                                <input type="checkbox" name="remember">

                                <span>Remember Me</span>

                            </label>

                            <a href="{{ route('password.request') }}">
                                Forgot Password?
                            </a>

                        </div>

                        <!-- Button -->
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
