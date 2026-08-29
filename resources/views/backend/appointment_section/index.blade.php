@extends('adminlte::page')

@section('title', 'Appointment List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="font-weight-bold mb-1">
                <i class="fas fa-calendar-check text-primary"></i>
                Appointment Management
            </h1>
            <p class="text-muted mb-0">
                Manage doctor consultations and service appointments
            </p>
        </div>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_action.css') }}">
    <!-- FILTER + SEARCH -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Search patient, doctor or service...">

                </div>
                <div class="col-md-3 mb-2">
                    <select id="statusFilter" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="col-md-3 mb-2">
                    <select id="typeFilter" class="form-control">
                        <option value="">All Types</option>
                        <option value="doctor">Doctor Consultation</option>
                        <option value="service">Service Appointment</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->hasRole('admin'))
        @include('backend.appointment_section.index_page.doctor_consultation_section')
        @include('backend.appointment_section.index_page.service_consultation_section')
    @elseif (auth()->user()->hasRole('doctor'))
        @include('backend.appointment_section.index_page.doctor_consultation_section')
    @endif
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/appointment_menu/index_page/appointment_filter.js') }}"></script>
@stop
