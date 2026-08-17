@extends('auth.layouts.auth-layout')

@section('auth_content')
    <div class="login-header">

        <div class="login-badge">
            <i class="fas fa-sync"></i>
            Reset Password
        </div>

        <h2>Create New Password</h2>

        <p>
            Create a strong and secure password for your account.
        </p>

    </div>

    <form method="POST" action="{{ route('password.store') }}">

        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="input-group-custom">

            <label>Email Address</label>

            <div class="input-wrapper">

                <i class="fas fa-envelope"></i>

                <input type="email" name="email" value="{{ old('email', $request->email) }}" required>

            </div>

        </div>

        <div class="input-group-custom">

            <label>New Password</label>

            <div class="input-wrapper">

                <i class="fas fa-lock"></i>

                <input type="password" name="password" placeholder="Enter new password" required>

            </div>

        </div>

        <div class="input-group-custom">

            <label>Confirm Password</label>

            <div class="input-wrapper">

                <i class="fas fa-lock"></i>

                <input type="password" name="password_confirmation" placeholder="Confirm password" required>

            </div>

        </div>

        <button type="submit" class="login-btn">

            Reset Password

        </button>

    </form>
@endsection
