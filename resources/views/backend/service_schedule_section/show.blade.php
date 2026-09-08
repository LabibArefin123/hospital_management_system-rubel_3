@extends('adminlte::page')
@section('title', 'Service Schedule Details')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold">
            <i class="fas fa-calendar-day text-info mr-1"></i>
            Service Schedule Details
        </h1>
        <a href="{{ route('service-schedules.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
@stop
@section('content')
    @include('backend.service_schedule_section.partial_layout.show_page.part_1')
    @include('backend.service_schedule_section.partial_layout.show_page.part_2')
@stop
