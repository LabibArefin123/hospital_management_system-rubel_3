@extends('adminlte::page')

@section('title', 'Create Service')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/content_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/form_part/service_form_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/form_part/service_form_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/form_part/service_form_validation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/form_part/service_form_fields.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/form_part/service_form_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/image_part/service_image_section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/image_part/service_image_preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/image_part/service_image_label.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/image_part/service_image_frame.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/image_part/service_image_upload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/create_page/content_instruction.css') }}">
@stop

@section('content_header')
    <div class="service-create-header">
        <h3>Create Service</h3>
        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm back-btn">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
@stop

@section('content')
    <div class="card shadow">
        <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
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
                {{-- BASIC FORM --}}
                @include('backend.service_page.partial_layout.create_page.part_1')
                {{-- INSTRUCTIONS --}}
                @include('backend.service_page.partial_layout.create_page.part_2')
                {{-- IMAGE --}}
                @include('backend.service_page.partial_layout.create_page.part_3')
            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i>
                    Save
                </button>
            </div>
        </form>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/service_section/create_page/image_preview.js') }}"></script>
    <script src="{{ asset('js/custom_backend/service_section/create_page/instruction-repeat.js') }}"></script>
@stop
