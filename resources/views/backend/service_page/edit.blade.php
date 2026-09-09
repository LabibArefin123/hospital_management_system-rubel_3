@extends('adminlte::page')

@section('title', 'Edit Service')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/content_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/form_part/service_form_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/form_part/service_form_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/form_part/service_form_validation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/form_part/service_form_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/form_part/service_form_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/image_part/service_image_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/image_part/service_image_preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/image_part/service_image_label.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/image_part/service_image_frame.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/image_part/service_image_upload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/edit_page/content_instruction.css') }}">
@stop

@section('content_header')
    <div class="service-edit-header">
        <h3>Edit Service</h3>

        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm back-btn">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow">
        <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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

                {{-- BASIC FORM --}}
                @include('backend.service_page.partial_layout.edit_page.part_1')
                {{-- INSTRUCTIONS --}}
                @include('backend.service_page.partial_layout.edit_page.part_2')
                {{-- IMAGE  --}}
                @include('backend.service_page.partial_layout.edit_page.part_3')
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i>
                        Update
                    </button>
                </div>
        </form>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/service_section/edit_page/instruction-repeat.js') }}"></script>
    <script src="{{ asset('js/custom_backend/service_section/edit_page/image-validation-modal.js') }}"></script>
    <script src="{{ asset('js/custom_backend/service_section/edit_page/image-info.js') }}"></script>
@stop
