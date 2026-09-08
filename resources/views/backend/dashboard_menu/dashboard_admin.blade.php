@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    @include('backend.dashboard_menu.custom_header.admin')
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/custom_components/custom_datatable/datatable_components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/admin_part/header_part/dashboard_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/admin_part/filter_part/admin_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/admin_part/section_part/header_part.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/admin_part/section_part/appointment_patient.css') }}">
@stop

@section('content')
    {{-- Filter section --}}
    @include('backend.dashboard_menu.custom_filter.admin.top_filter')
    {{-- Card Box section --}}
    @include('backend.dashboard_menu.partials.admin_part.card-box')
    {{-- Latest Appointment section --}}
    @include('backend.dashboard_menu.partials.admin_part.latest_appointment')
    <div class="row">
        {{-- Doctor appointment part --}}
        @include('backend.dashboard_menu.partials.admin_part.doctor_appointments')
        {{-- Service appointment part --}}
        @include('backend.dashboard_menu.partials.admin_part.service_appointments')
    </div>
    @include('backend.dashboard_menu.partials.admin_part.status_modal')
@endsection

@section('js')
    <script src="{{ asset('js/custom_backend/dashboard_page/admin/appointment_status.js') }}"></script>
    <script src="{{ asset('js/custom_backend/dashboard_page/admin/appointment_info_status.js') }}"></script>
    <script type="module" src="{{ asset('js/custom_backend/dashboard_page/admin/dashboard-init.js') }}"></script>
@endsection
