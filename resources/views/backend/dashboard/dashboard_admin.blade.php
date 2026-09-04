@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    @include('backend.dashboard.custom_header.admin')
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/admin_part/header_part/dashboard_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/admin_part/filter_part/admin_filter.css') }}">
@stop

@section('content')
    {{-- Filter section --}}
    @include('backend.dashboard.custom_filter.admin.top_filter')
    {{-- Card Box section --}}
    @include('backend.dashboard.partials.card-box')
    {{-- Latest Appointment section --}}
    @include('backend.dashboard.partials.latest_appointment')
    <div class="row">
        {{-- Doctor appointment part --}}
        @include('backend.dashboard.partials.doctor_appointments')
        {{-- Service appointment part --}}
        @include('backend.dashboard.partials.service_appointments')
    </div>
    @include('backend.dashboard.partials.status_modal')
    <script src="{{ asset('js/custom_backend/dashboard_page/admin/appointment_status.js') }}"></script>
    <script type="module" src="{{ asset('js/custom_backend/dashboard_page/admin/dashboard-init.js') }}"></script>
@endsection
