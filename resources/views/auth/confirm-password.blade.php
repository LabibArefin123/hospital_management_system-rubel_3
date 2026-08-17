@extends('auth.layouts.auth-layout')

@section('auth_content')

<div class="login-header">

    <div class="login-badge">
        <i class="fas fa-lock"></i>
        Secure Confirmation
    </div>

    <h2>Confirm Password</h2>

    <p>
        Please confirm your password before continuing.
    </p>

</div>

<form method="POST" action="{{ route('password.confirm') }}">

    @csrf

    <div class="input-group-custom">

        <label>Password</label>

        <div class="input-wrapper">

            <i class="fas fa-lock"></i>

            <input type="password"
                name="password"
                placeholder="Enter your password"
                required>

        </div>

        <x-input-error :messages="$errors->get('password')" class="error-text mt-2" />

    </div>

    <button type="submit" class="login-btn">

        Confirm Password

    </button>

</form>

@endsection