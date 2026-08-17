@extends('adminlte::page')

@section('title', 'Doctor Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Doctor Profile</h3>
        <div>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- LEFT SIDE --}}
            @include('backend.doctor_section.partial_layout.show_page.part_1')
            
            {{-- RIGHT SIDE --}}
            @include('backend.doctor_section.partial_layout.show_page.part_2')

            {{-- PROFESSIONAL INFO --}}
            @include('backend.doctor_section.partial_layout.show_page.part_3')
        </div>

        @include('backend.doctor_section.custom_modal.show_page.image_modal')
    </div>
@stop
