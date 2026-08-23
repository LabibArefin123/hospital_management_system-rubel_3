@extends('adminlte::page')
@section('title', 'Appointment Details')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0"><i class="fas fa-calendar-check text-primary mr-2"></i>Appointment Details</h1>
        <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-secondary"><i
                class="fas fa-arrow-left mr-1"></i>Back</a>
    </div>
@stop
@section('content')
    @include('backend.appointment_section.show_page.part_1')
    @include('backend.appointment_section.show_page.part_2')
    @include('backend.appointment_section.show_page.part_3')
    @include('backend.appointment_section.show_page.part_4')
@stop
