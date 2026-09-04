@extends('frontend.layouts.app')

@section('title', 'All Appointments')

@section('content')
    @include('frontend.custom_layout.header')
    @include('frontend.appointment_page.modals.doctor_filter')
    @if (!auth()->user() || !auth()->user()->hasRole('doctor'))
        @include('frontend.appointment_page.modals.service_filter')
    @endif
    <!-- ================= DOCTOR APPOINTMENTS ================= -->
    @include('frontend.appointment_page.partials.doctor_appointment')
    @if (!auth()->user() || !auth()->user()->hasRole('doctor'))
        <!-- ================= SERVICE APPOINTMENTS ================= -->
        @include('frontend.appointment_page.partials.service_appointment')
    @endif
    @include('frontend.custom_layout.footer')
@endsection