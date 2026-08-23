@extends('adminlte::page')
@section('title', 'Create Service Schedule')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add New Service Schedule</h1>
        <a href="{{ route('service-schedules.index') }}"
            class="btn btn-sm btn-warning d-flex align-items-center gap-1 flex-shrink-0 back-btn">
            <i class="fas fa-arrow-left"></i> Go Back
        </a>
    </div>
@stop
@section('content')
    @include('backend.service_schedule_section.partial_layout.create_page.part_1')
    @include('backend.service_schedule_section.partial_layout.create_page.part_2')
@stop
@section('js')
    <script src="{{ asset('js/custom_backend/service_schedule/create_page/service-preview.js') }}"></script>
@stop
