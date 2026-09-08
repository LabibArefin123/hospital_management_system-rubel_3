@extends('adminlte::page')

@section('title', 'Edit Doctor Schedule')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/schedule_management/doctor_schedule/edit_page/input_hidden.css') }}">
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
        <h3>Edit Schedule Doctor</h3>
        <a href="{{ route('doctor-schedules.index') }}" class="doctor-schedule-back-btn btn btn-secondary"><i
                class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>
@stop

@section('content')
    {{-- DOCTOR PREVIEW SECTION --}}
    @include('backend.doctor_schedule_section.partial_layout.edit_page.part_1')
    {{-- FORM SECTION --}}
    @include('backend.doctor_schedule_section.partial_layout.edit_page.part_2')
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/doctor_schedule_section/edit_page/doctor-preview.js') }}"></script>
@stop
