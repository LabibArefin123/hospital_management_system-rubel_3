@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content')

    <div class="container-fluid">
        @include('backend.dashboard.custom_header.admin')
        {{-- Card Box section --}}
        @include('backend.dashboard.custom_filter.admin.top_filter')

        {{-- Card Box section --}}
        @include('backend.dashboard.partials.card-box')

        {{-- Latest Appointment section --}}
        @include('backend.dashboard.partials.latest_appointment')
        <div class="row">

            @php

                $doctorAppointments = $appointments->filter(function ($appointment) {
                    return $appointment->doctor;
                });

                $serviceAppointments = $appointments->filter(function ($appointment) {
                    return $appointment->service && !$appointment->doctor;
                });

            @endphp

            {{-- Doctor appointment part --}}
            @include('backend.dashboard.partials.doctor_appointments')
            {{-- Service appointment part --}}
            @include('backend.dashboard.partials.service_appointments')

        </div>
        @include('backend.dashboard.partials.status_modal')
        {{-- PAGINATION --}}
        <div class="mt-4 d-flex justify-content-center">

            {{ $appointments->links() }}

        </div>

    </div>
    <script src="{{ asset('js/custom_backend/dashboard_page/admin/appointment_status.js') }}"></script>
    <script type="module" src="{{ asset('js/custom_backend/dashboard_page/admin/dashboard-init.js') }}"></script>
@endsection
