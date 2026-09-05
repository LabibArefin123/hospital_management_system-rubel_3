@extends('adminlte::page')

@section('title', 'Edit Doctor')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/edit_page/doctor_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/edit_page/doctor_create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/edit_page/doctor_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/edit_page/doctor_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/edit_page/doctor_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/edit_page/doctor_responsive.css') }}">
@stop

@section('content_header')
    <div class="doctor-page-header">
        <div class="doctor-header-content">
            <div class="doctor-header-icon">
                <i class="fas fa-user-md"></i>
            </div>

            <div>
                <h1>Edit Doctor</h1>
                <p>Update the doctor's professional profile and account information.</p>
            </div>
        </div>

        <a href="{{ route('doctors.index') }}" class="doctor-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Doctors</span>
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="doctor-create-card">
                <div class="doctor-create-header">
                    <div>
                        <h3>
                            <i class="fas fa-user-edit"></i>
                            Update Doctor Information
                        </h3>
                        <p>
                            Update the doctor's profile, consultation details, image, and account.
                        </p>
                    </div>
                </div>

                <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="doctor-create-body">

                        {{-- This is for validation errors --}}
                        @if ($errors->any())
                            <div class="doctor-error-box">
                                <div class="doctor-error-title">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Please check the following errors
                                </div>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- This is for doctor basic information --}}
                        @include('backend.doctor_section.partial_layout.edit_page.part_1')
                        {{-- This is for doctor experience information --}}
                        @include('backend.doctor_section.partial_layout.edit_page.part_2')
                        {{-- This is for doctor professional information --}}
                        @include('backend.doctor_section.partial_layout.edit_page.part_3')
                        {{-- This is for consultation information --}}
                        @include('backend.doctor_section.partial_layout.edit_page.part_4')
                        {{-- This is for doctor about information --}}
                        @include('backend.doctor_section.partial_layout.edit_page.part_5')
                        {{-- This is for doctor account information --}}
                        @include('backend.doctor_section.partial_layout.edit_page.part_6')
                        {{-- This is for doctor image --}}
                        @include('backend.doctor_section.partial_layout.edit_page.part_7')
                    </div>

                    {{-- This is for edit actions --}}
                    <div class="doctor-create-footer">
                        <a href="{{ route('doctors.index') }}" class="doctor-cancel-btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>

                        <button type="submit" class="doctor-save-btn">
                            <i class="fas fa-save"></i>
                            Update Doctor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/doctor_management/edit_page/image_preview.js') }}"></script>
    <script src="{{ asset('js/custom_backend/doctor_management/edit_page/password_toggle.js') }}"></script>
@stop
