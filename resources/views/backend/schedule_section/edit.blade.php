@extends('adminlte::page')

@section('title', 'Edit Doctor Schedule')

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
    @include('backend.schedule_section.partial_layout.edit_page.part_1')
    {{-- FORM SECTION --}}
    @include('backend.schedule_section.partial_layout.edit_page.part_2')
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/schedule_section/edit_page/doctor-preview.js') }}"></script>
@stop
