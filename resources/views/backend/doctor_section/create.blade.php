@extends('adminlte::page')

@section('title', 'Create Doctor')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Add New Doctor</h1>
        <a href="{{ route('doctors.index') }}"
            class="btn btn-sm btn-warning d-flex align-items-center gap-1 flex-shrink-0 back-btn">
            <i class="fas fa-arrow-left"></i> Go Back
        </a>
    </div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h3 class="card-title font-weight-bold">
                        Doctor Information
                    </h3>
                </div>

                <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        {{-- ERRORS --}}
                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif
                        @include('backend.doctor_section.partial_layout.create_page.part_1')
                        @include('backend.doctor_section.partial_layout.create_page.part_2')
                        @include('backend.doctor_section.partial_layout.create_page.part_3')
                        @include('backend.doctor_section.partial_layout.create_page.part_4')

                        <div class="form-group">
                            <label>About Doctor</label>
                            <textarea name="about" rows="5" class="form-control" placeholder="Write doctor profile..."></textarea>
                        </div>
                        @include('backend.doctor_section.partial_layout.create_page.part_5')
                        <div class="form-group">
                            <label class="font-weight-bold">Doctor Image</label>
                            <br>
                            <button type="button" class="btn btn-primary" id="openImageModal">
                                <i class="fas fa-image mr-1"></i>
                                Add Image
                            </button>
                            <input type="file" name="image" id="doctorImageInput" class="d-none" accept="image/*">
                        </div>

                        <div class="card-footer bg-white text-right">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save"></i>
                                Save Doctor
                            </button>
                        </div>
                        @include('backend.doctor_section.custom_modal.create_page.image_upload_modal')
                        @include('backend.doctor_section.custom_modal.create_page.replace_upload_modal')
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/doctor_management/create_page/image-validation-modal.js') }}"></script>
@stop
