@extends('auth.layouts.auth-layout')

@section('auth_content')
    <div class="login-header">

        <div class="login-badge">
            <i class="fas fa-mobile-alt"></i>
            Phone Verification
        </div>

        <h2>Verify Your Phone</h2>

        <p>
            Enter the 6-digit verification code sent to your phone.
        </p>

    </div>

    @if (session('message'))
        <div class="alert alert-info mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.verifyPhone') }}">

        @csrf

        <div class="input-group-custom">

            <label>Verification Code</label>

            <div class="input-wrapper">

                <i class="fas fa-key"></i>

                <input type="text" name="verification_code" maxlength="6" pattern="\d{6}"
                    placeholder="Enter verification code" required>

            </div>

            @error('verification_code')
                <small class="error-text">
                    {{ $message }}
                </small>
            @enderror

        </div>

        <button type="submit" class="login-btn">

            Verify & Continue

        </button>

    </form>
@endsection
