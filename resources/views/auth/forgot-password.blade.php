@extends('auth.layouts.auth-layout')

@section('auth_content')

<div class="login-header">
    <h2>Forgot Password?</h2>

    <p>
        Enter your email address and we'll send you
        a secure password reset link.
    </p>

</div>

<x-auth-session-status class="alert alert-success mb-4" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}">

    @csrf

    <div class="input-group-custom">

        <label>Email Address</label>

        <div class="input-wrapper">

            <i class="fas fa-envelope"></i>

            <input type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email address"
                required
                autofocus>

        </div>

        <x-input-error :messages="$errors->get('email')" class="error-text mt-2" />

    </div>

    <button type="submit" class="login-btn">

        <i class="fas fa-paper-plane me-2"></i>

        Send Reset Link

    </button>

</form>

@endsection