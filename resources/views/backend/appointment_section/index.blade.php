@extends('adminlte::page')

@section('title', 'Appointment List')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_patient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_provider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_action.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_resp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/pagination_part/appointment_pagination.css') }}">
@stop

@section('content_header')
    <div class="appointment-page-header">
        <div class="appointment-page-heading">
            <div class="appointment-page-icon"><i class="fas fa-calendar-check"></i></div>
            <div>
                <h1>Appointment Management</h1>
                <p>Manage doctor consultations and healthcare service appointments.</p>
            </div>
        </div>
        <div class="appointment-page-summary">
            <span><i class="fas fa-calendar-alt"></i> {{ $doctorAppointments->count() + $serviceAppointments->count() }}
                Total</span>
        </div>
    </div>
@stop

@section('content')
    <div class="appointment-filter-card">
        <div class="appointment-filter-header">
            <div>
                <h5><i class="fas fa-sliders-h"></i> Appointment Filters</h5>
                <span>Search and filter appointments quickly.</span>
            </div>
            <div class="appointment-filter-indicator">
                <i class="fas fa-filter"></i>
            </div>
        </div>
        <div class="appointment-filter-body">
            <div class="row">
                <div class="col-lg-5 col-md-6 mb-3 mb-md-0">
                    <label class="appointment-filter-label">Search</label>
                    <div class="appointment-search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control appointment-filter-control"
                            placeholder="Search patient, doctor or service...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 mb-3 mb-md-0">
                    <label class="appointment-filter-label">Status</label>
                    <select id="statusFilter" class="form-control appointment-filter-control">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 mb-3 mb-md-0">
                    <label class="appointment-filter-label">Appointment Type</label>
                    <select id="typeFilter" class="form-control appointment-filter-control">
                        <option value="">All Types</option>
                        <option value="doctor">Doctor Consultation</option>
                        <option value="service">Service Appointment</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-12 d-flex align-items-end">
                    <button type="button" id="clearAppointmentFilters" class="appointment-clear-btn" title="Clear Filters">
                        <i class="fas fa-redo-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole('admin'))
        @include('backend.appointment_section.index_page.doctor_consultation_section')
        @include('backend.appointment_section.index_page.service_consultation_section')
    @elseif(auth()->user()->hasRole('doctor'))
        @include('backend.appointment_section.index_page.doctor_consultation_section')
    @endif
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/appointment_menu/index_page/appointment_filter.js') }}"></script>
@stop
