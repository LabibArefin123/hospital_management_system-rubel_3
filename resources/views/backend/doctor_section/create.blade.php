@extends('adminlte::page')

@section('title', 'Create Doctor')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/create_page/doctor_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/create_page/doctor_create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/create_page/doctor_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/create_page/doctor_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/create_page/doctor_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/create_page/doctor_responsive.css') }}">
@stop

@section('content_header')
    <div class="doctor-page-header">
        <div class="doctor-header-content">
            <div class="doctor-header-icon">
                <i class="fas fa-user-md"></i>
            </div>

            <div>
                <h1>Add New Doctor</h1>
                <p>Create a professional doctor profile and manage their information.</p>
            </div>
        </div>

        <a href="{{ route('doctors.index') }}" class="doctor-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Go Back</span>
        </a>
    </div>
@stop

@section('content')
    {{-- This is for doctor create page --}}
    <div class="row">
        <div class="col-12">
            <div class="doctor-create-card">

                {{-- This is for doctor form header --}}
                <div class="doctor-create-header">
                    <div>
                        <h3>
                            <i class="fas fa-user-md"></i>
                            Doctor Information
                        </h3>
                        <p>Enter the doctor's professional and account details.</p>
                    </div>
                </div>

                <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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

                        {{-- This is for basic doctor information --}}
                        @include('backend.doctor_section.partial_layout.create_page.part_1')

                        {{-- This is for doctor experience information --}}
                        @include('backend.doctor_section.partial_layout.create_page.part_2')

                        {{-- This is for doctor qualification information --}}
                        @include('backend.doctor_section.partial_layout.create_page.part_3')

                        {{-- This is for consultation information --}}
                        @include('backend.doctor_section.partial_layout.create_page.part_4')

                        {{-- This is for doctor account information --}}
                        @include('backend.doctor_section.partial_layout.create_page.part_5')

                        {{-- This is for doctor about information --}}
                        <div class="doctor-form-section">
                            <div class="doctor-section-title">
                                <i class="fas fa-file-medical"></i>
                                About Doctor
                            </div>

                            <div class="form-group">
                                <label for="about">Doctor Profile</label>

                                <textarea name="about" id="about" rows="5" class="form-control"
                                    placeholder="Write a short professional profile about the doctor...">{{ old('about') }}</textarea>

                                @error('about')
                                    <span class="doctor-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- This is for doctor image --}}
                        <div class="doctor-image-section">

                            <div class="doctor-section-title">
                                <i class="fas fa-image"></i>
                                Doctor Image
                            </div>

                            <p class="doctor-image-help">
                                Upload a professional doctor image. The preview will appear instantly.
                            </p>

                            <div class="doctor-image-preview-grid">

                                {{-- This is for default image --}}
                                <div class="doctor-image-preview-card">
                                    <div class="doctor-image-preview-header">
                                        <div>
                                            <strong>Default Image</strong>
                                            <span>Current placeholder</span>
                                        </div>

                                        <span class="doctor-image-label default">
                                            <i class="fas fa-image"></i>
                                            Default
                                        </span>
                                    </div>

                                    <div class="doctor-image-preview-frame">
                                        <img src="{{ asset('uploads/images/default.jpg') }}" alt="Default Doctor Image">
                                    </div>
                                </div>

                                {{-- This is for new image preview --}}
                                <div class="doctor-image-preview-card">
                                    <div class="doctor-image-preview-header">
                                        <div>
                                            <strong>New Image</strong>
                                            <span>Uploaded doctor image</span>
                                        </div>

                                        <span class="doctor-image-label new">
                                            <i class="fas fa-camera"></i>
                                            Preview
                                        </span>
                                    </div>

                                    <div class="doctor-image-preview-frame doctor-new-image-frame">
                                        <img src="{{ asset('uploads/images/default.jpg') }}" id="doctorImagePreview"
                                            alt="New Doctor Image">
                                    </div>
                                </div>

                            </div>

                            {{-- This is for image upload --}}
                            <div class="doctor-image-upload">
                                <input type="file" name="image" id="doctorImageInput" class="doctor-image-input"
                                    accept="image/*">

                                <label for="doctorImageInput" class="doctor-image-upload-btn">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Choose Doctor Image</span>
                                </label>

                                <small id="doctorImageName" class="doctor-image-name">
                                    No image selected
                                </small>

                                @error('image')
                                    <span class="doctor-field-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                    </div>

                    {{-- This is for doctor form actions --}}
                    <div class="doctor-create-footer">
                        <a href="{{ route('doctors.index') }}" class="doctor-cancel-btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>

                        <button type="submit" class="doctor-save-btn">
                            <i class="fas fa-save"></i>
                            Save Doctor
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/doctor_management/create_page/image_preview.js') }}"></script>
    <script src="{{ asset('js/custom_backend/doctor_management/create_page/password_toggle.js') }}"></script>
@stop
