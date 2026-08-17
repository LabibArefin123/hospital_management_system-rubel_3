@extends('adminlte::page')

@section('title', 'Add New Role')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/create_page/create.css') }}">
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="fw-bold text-dark mb-1">
                Create New Role
            </h1>

            <p class="text-muted mb-0">
                Configure role permissions and access management.
            </p>
        </div>

        <a href="{{ route('roles.index') }}"
            class="btn btn-outline-secondary rounded-pill px-4 shadow-sm d-flex align-items-center gap-2">

            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back
        </a>
    </div>
@stop

@section('content')
    {{-- ERROR ALERT --}}
    @include('backend.setting_management.roles_and_permission.roles.partial_layout.error_message')
    <form method="POST" action="{{ route('roles.store') }}" data-confirm="create">
        @csrf
        {{-- ROLE INFO --}}
         @include('backend.setting_management.roles_and_permission.roles.partial_layout.create_page.part_1')
         {{-- GLOBAL ACTION --}}
         @include('backend.setting_management.roles_and_permission.roles.partial_layout.create_page.part_2')
         
         {{-- PERMISSION SECTION --}}
         <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
             {{-- HEADER --}}
             @include('backend.setting_management.roles_and_permission.roles.partial_layout.create_page.part_3')
             {{-- SCROLLABLE BODY --}}
             @include('backend.setting_management.roles_and_permission.roles.partial_layout.create_page.part_4')
        </div>

        {{-- SUBMIT --}}
        <div class="text-end mt-4 mb-5">
            <button type="submit" class="btn btn-success btn-lg rounded-pill px-5 shadow-lg">
                <i class="fas fa-save me-2"></i>
                Save Role
            </button>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/create_page/role-global-select.js') }}"></script>
    <script src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/create_page/role-global-unselect.js') }}"></script>
    <script src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/create_page/role-group-select.js') }}"></script>
    <script src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/create_page/role-group-unselect.js') }}"></script>
@stop

