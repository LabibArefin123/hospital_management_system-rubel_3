@extends('adminlte::page')

@section('title', 'Schedule Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold">
            <i class="fas fa-calendar-day text-info mr-1"></i>
            Schedule Details
        </h1>

        <a href="{{ route('doctor-schedules.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
@stop

@section('content')
    {{-- DOCTOR PROFILE SECTION --}}
    @include('backend.schedule_section.partial_layout.show_page.part_1')
    {{-- SCHEDULE INFORMATION SECTION --}}
    @include('backend.schedule_section.partial_layout.show_page.part_2')
@stop
