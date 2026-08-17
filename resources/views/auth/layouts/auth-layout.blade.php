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

            <!-- LEFT -->
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


            <!-- RIGHT -->
            <div class="login-side">

                <div class="login-card">

                    @yield('auth_content')

                </div>

            </div>

        </div>

    </div>
@endsection
