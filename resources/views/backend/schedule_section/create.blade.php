@extends('adminlte::page')

@section('title', 'Create Doctor Schedule')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add New Doctor Schedule</h1>
        <a href="{{ route('doctor-schedules.index') }}"
            class="btn btn-sm btn-warning d-flex align-items-center gap-1 flex-shrink-0 back-btn">
            <i class="fas fa-arrow-left"></i> Go Back
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
