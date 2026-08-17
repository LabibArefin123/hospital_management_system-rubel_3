@extends('frontend.layouts.app')

@section('title', 'My Profile - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- PROFILE INTRO -->
    <section class="contact-intro">
        <div class="container text-center">
            <h2>My Profile</h2>
            <p>Manage your account information</p>
        </div>
    </section>

    <!-- PROFILE SECTION -->
    <section class="contact-section">
        <div class="container">

            <div class="contact-wrapper">

                <!-- LEFT PROFILE CARD -->
                <div class="contact-form-box text-center">

                    <img src="{{ Auth::user()->avatar ?? 'https://via.placeholder.com/100' }}" class="rounded-circle mb-3"
                        width="100" height="100">

                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>

                    <hr>

                    <div class="mt-3">

                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf
                            <button class="btn btn-danger w-100">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

                <!-- RIGHT INFO -->
                <div class="contact-right">

                    <div class="info-card">
                        <h5>Account Info</h5>
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>

                    <div class="info-card">
                        <h5>Quick Actions</h5>
                        <p>✔ Book Appointments</p>
                        <p>✔ View Doctors</p>
                        <p>✔ Manage Your Visits</p>
                    </div>

                    <div class="info-card">
                        <h5>Status</h5>
                        <strong class="text-success">Active User</strong>
                    </div>

                </div>

            </div>

        </div>
    </section>

    @include('frontend.custom_layout.footer')

@endsection
