@extends('frontend.layouts.app')

@section('title', 'My Appointments')

@section('content')
    @include('frontend.custom_layout.header')
    <!-- ================= DOCTOR APPOINTMENTS ================= -->
    <section class="appointment-section">
        <div class="container">
            <h3 class="section-title">All Doctor Appointments</h3>
            @if ($doctorAppointments->count() == 0)
                <p class="empty-text">No doctor appointments</p>
            @endif

            <div class="appointment-grid">
                @foreach ($doctorAppointments as $app)
                    <div class="appointment-card">
                        <div class="top-img">
                            <img src="{{ asset($app->doctor->image) }}" alt="{{ $app->doctor->name }}">
                        </div>

                        <h4>{{ $app->doctor->name }}</h4>
                        <p>{{ $app->doctor->speciality }}</p>

                        <div class="patient-info">
                            <div>
                                <strong>Patient:</strong>
                                {{ $app->name }}
                            </div>

                            <div>
                                <strong>Age:</strong>
                                {{ $app->age }}
                            </div>

                            @if ($app->email)
                                <div>
                                    <strong>Email:</strong>
                                    {{ $app->email }}
                                </div>
                            @endif
                        </div>

                        <div class="time-box">
                            <span>{{ \Carbon\Carbon::parse($app->appointment_date)->format('d M Y') }}</span>
                        </div>

                        <div class="time-box">
                            <span>{{ \Carbon\Carbon::parse($app->appointment_time)->format('h:i A') }}</span>
                        </div>

                        <div class="bottom-info">
                            <div class="payment">
                                {{ $app->payment_method }}
                            </div>

                            <div class="status {{ $app->status }}">
                                {{ ucfirst($app->status) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= SERVICE APPOINTMENTS ================= -->
    <section class="appointment-section">
        <div class="container">
            <h3 class="section-title">All Booked Services</h3>

            @if ($serviceAppointments->count() == 0)
                <p class="empty-text">No service booking found</p>
            @endif

            <div class="appointment-grid">
                @foreach ($serviceAppointments as $app)
                    <div class="appointment-card">
                        <div class="top-img">
                            <img src="{{ asset($app->service->image) }}" alt="{{ $app->service->title }}">
                        </div>

                        <h4>{{ $app->service->title }}</h4>
                        <div class="patient-info">
                            <div>
                                <strong>Patient:</strong>
                                {{ $app->name }}
                            </div>

                            <div>
                                <strong>Age:</strong>
                                {{ $app->age }}
                            </div>
                        </div>

                        <div class="time-box">
                            <span>
                                {{ \Carbon\Carbon::parse($app->appointment_date)->format('d M Y') }}
                            </span>
                        </div>

                        <div class="time-box">
                            <span>
                                {{ \Carbon\Carbon::parse($app->appointment_time)->format('h:i A') }}
                            </span>
                        </div>

                        <div class="bottom-info">
                            <div class="payment">
                                {{ $app->payment_method }}
                            </div>

                            <div class="status {{ $app->status }}">
                                {{ ucfirst($app->status) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('frontend.custom_layout.footer')
@endsection
