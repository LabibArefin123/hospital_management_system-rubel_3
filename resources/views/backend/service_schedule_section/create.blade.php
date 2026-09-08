@extends('adminlte::page')

@section('title', 'Create Service Schedule')

@section('adminlte_css')
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/service_schedule/shared_layout/service_header.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/service_schedule/shared_layout/service_preview.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/service_schedule/shared_layout/service_form.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/service_schedule/shared_layout/service_actions.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/schedule_management/service_schedule/shared_layout/service_resp.css') }}">
@stop

@section('content_header')
    <div class="service-schedule-header">
        <h1>Add New Service Schedule</h1>
        <a href="{{ route('service-schedules.index') }}" class="service-schedule-back-btn btn btn-warning">
            <i class="fas fa-arrow-left"></i>
            <span>Go Back</span>
        </a>
    </div>
@stop

@section('content')
    @include('backend.service_doctor_schedule_section.partial_layout.create_page.part_1')
    @include('backend.service_doctor_schedule_section.partial_layout.create_page.part_2')
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/service_schedule/create_page/service-preview.js') }}"></script>
@stop
