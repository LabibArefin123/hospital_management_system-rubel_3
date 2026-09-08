@extends('adminlte::page')

@section('title', 'Doctor Details')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/show_page/doctor_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/show_page/doctor_base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/show_page/doctor_profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/show_page/doctor_overview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/show_page/doctor_professional.css') }}">
@stop

@section('content_header')
    <div class="doctor-page-header">
        <div class="doctor-page-header-content">
            <div class="doctor-page-header-icon"><i class="fas fa-user-md"></i></div>
            <div>
                <h3 class="doctor-page-header-title">Doctor Profile</h3>
                <p class="doctor-page-header-subtitle">View and manage doctor professional information</p>
            </div>
        </div>
        <div class="doctor-page-header-actions">
            <a href="{{ route('doctors.index') }}" class="doctor-page-header-btn doctor-page-header-btn-back"><i
                    class="fas fa-arrow-left"></i>Back</a>
            <a href="{{ route('doctors.edit', $doctor->id) }}" class="doctor-page-header-btn doctor-page-header-btn-edit"><i
                    class="fas fa-edit"></i>Edit</a>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid doctor-show-page">
        <div class="doctor-show-overview">
            {{-- LEFT SIDE --}}
            @include('backend.doctor_page.partial_layout.show_page.part_1')
            {{-- RIGHT SIDE --}}
            @include('backend.doctor_page.partial_layout.show_page.part_2')
            {{-- PROFESSIONAL INFO --}}
        </div>
        <div class="doctor-show-section">
            @include('backend.doctor_page.partial_layout.show_page.part_3')
        </div>
    </div>
@stop
