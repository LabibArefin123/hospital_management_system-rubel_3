@extends('auth.layouts.auth-layout')

@section('auth_content')
    <div class="login-header">

        <div class="login-badge">
            <i class="fas fa-envelope-open-text"></i>
            Email Verification
        </div>

        <h2>Verify Your Email</h2>

        <p>
            We've sent a verification link to your email address.
            Please verify your account to continue.
        </p>

    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            A new verification link has been sent successfully.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">

        @csrf

        <button type="submit" class="login-btn">

            Resend Verification Email

        </button>

    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">

        @csrf

        <button type="submit" class="btn btn-light w-100 rounded-4 py-3">

            Logout

        </button>

    </form>
@endsection
