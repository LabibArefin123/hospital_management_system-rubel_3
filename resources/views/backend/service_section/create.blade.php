@extends('adminlte::page')

@section('title', 'Create Service')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
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
                @include('backend.service_section.partial_layout.create_page.part_1')
                {{-- INSTRUCTIONS --}}
                @include('backend.service_section.partial_layout.create_page.part_2')
                {{-- IMAGE --}}
                @include('backend.service_section.partial_layout.create_page.part_3')


            </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i>
                    Save
                </button>
            </div>
        </form>

        @include('backend.service_section.custom_modal.create_page.image_upload_modal')

        @include('backend.service_section.custom_modal.create_page.replace_upload_modal')

    </div>


@stop

@section('js')
    <script src="{{ asset('js/custom_backend/service_section/create_page/instruction-repeat.js') }}"></script>
    <script src="{{ asset('js/custom_backend/service_section/create_page/image-validation-modal.js') }}"></script>
@stop
