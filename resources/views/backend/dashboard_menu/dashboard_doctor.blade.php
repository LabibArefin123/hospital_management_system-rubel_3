@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content_header')
    @include('backend.dashboard_menu.custom_header.doctor')
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/doctor_part/header_part/dashboard_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/doctor_part/filter_part/doctor_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/doctor_part/section_part/header_part.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/doctor_part/section_part/appointment_patient.css') }}">
@stop
@section('content')
    {{-- Card Box section --}}
    @include('backend.dashboard_menu.custom_filter.doctor.top_filter')
    @include('backend.dashboard_menu.partials.doctor_part.card-box')
    {{-- Latest Appointment section --}}
    @include('backend.dashboard_menu.partials.doctor_part.latest_appointment')
    <div class="row">
        {{-- Doctor appointment part --}}
        @include('backend.dashboard_menu.partials.doctor_part.doctor_appointments')
        {{-- Service appointment part --}}
    </div>
    @include('backend.dashboard_menu.partials.doctor_part.status_modal')
@endsection

@section('js')
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/appointment_status.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/appointment_info_status.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/doctor_filter.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/doctor_filter_toggle.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/doctor_filter_appointments.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/doctor_filter_datatable.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/doctor_filter_reset.js') }}"></script>
@stop
