@extends('adminlte::page')

@section('title', 'Create Doctor Schedule')

@section('adminlte_css')
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/doctor_schedule/shared_layout/doctor_header.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/doctor_schedule/shared_layout/doctor_preview.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/doctor_schedule/shared_layout/doctor_form.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/doctor_schedule/shared_layout/doctor_actions.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/doctor_schedule/shared_layout/doctor_resp.css') }}">
@stop

@section('content_header')
    <div class="doctor-schedule-header">
        <h1>Add New Doctor Schedule</h1>
        <a href="{{ route('doctor-schedules.index') }}" class="doctor-schedule-back-btn btn btn-warning"><i
                class="fas fa-arrow-left"></i>
            <span>Go Back</span>
        </a>
    </div>
@stop

@section('content')
    {{-- DOCTOR PREVIEW SECTION --}}
    @include('backend.schedule_section.partial_layout.create_page.part_1')
    {{-- FORM SECTION --}}
    @include('backend.schedule_section.partial_layout.create_page.part_2')

@stop

@section('js')
    <script src="{{ asset('js/custom_backend/schedule_section/create_page/doctor-preview.js') }}"></script>
@stop
