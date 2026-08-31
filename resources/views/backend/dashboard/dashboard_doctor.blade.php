@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content_header')
    @include('backend.dashboard.custom_header.doctor')
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/doctor_part/header_part/dashboard_header.css') }}">
@stop
@section('content')
    {{-- Card Box section --}}
    @include('backend.dashboard.custom_filter.doctor.top_filter')
    @include('backend.dashboard.partials.card-box')
    {{-- Latest Appointment section --}}
    @include('backend.dashboard.partials.latest_appointment')
    <div class="row">
        {{-- Doctor appointment part --}}
        @include('backend.dashboard.partials.doctor_appointments')
        {{-- Service appointment part --}}
    </div>
    @include('backend.dashboard.partials.status_modal')
@endsection

@section('js')
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/appointment_status.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/doctor_filter.js') }}"></script>
@endsection