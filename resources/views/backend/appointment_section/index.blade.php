@extends('adminlte::page')

@section('title', 'Appointment List')

@section('adminlte_css')
    {{-- Header Part --}}
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/header_part/appointment_header.css') }}">
    {{-- Start of Appointment Filter Part --}}
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/filter_part/appointment_filter_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/filter_part/appointment_filter_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/filter_part/appointment_filter_body.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/filter_part/appointment_filter_control.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/filter_part/appointment_filter_actions.css') }}">
    {{-- End of Appointment Filter Part --}}
    {{-- Start of Appointment Card Part --}}
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/card_part/appointment_card_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/card_part/appointment_card_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/card_part/appointment_card_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/card_part/appointment_card_details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/card_part/appointment_card_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/card_part/appointment_card_empty.css') }}">
    {{-- End of Appointment Card Part --}}
    {{-- Start of Patient Part --}}
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/patient_part/appointment_patient_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/patient_part/appointment_patient_info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/patient_part/appointment_patient_meta.css') }}">
    {{-- End of Patient Part --}}
    {{-- Start of Provider Part --}}
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/provider_part/appointment_provider_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/provider_part/appointment_provider_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/provider_part/appointment_provider_info.css') }}">
    {{-- End of Patient Part --}}
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_action.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/appointment_resp.css') }}">
    {{-- Start of Pagination --}}
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/pagination_part/appointment_pagination_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/pagination_part/appointment_pagination_info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/pagination_part/appointment_pagination_navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/pagination_part/appointment_pagination_states.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/pagination_part/appointment_pagination_resp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/appointment_page/index_page/pagination_part/appointment_pagination_mobile.css') }}">
    {{-- End of Pagination Part --}}
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
