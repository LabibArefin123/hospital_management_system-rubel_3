@extends('adminlte::page')
@section('title', 'Edit Service Schedule')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Edit Schedule Service</h3>
        <a href="{{ route('service-schedules.index') }}" class="back-btn btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
@stop
@section('content')
    @include('backend.service_schedule_section.partial_layout.edit_page.part_1')
    @include('backend.service_schedule_section.partial_layout.edit_page.part_2')
@stop
@section('js')
    <script src="{{ asset('js/custom_backend/service_schedule/edit_page/service-preview.js') }}"></script>
@stop
