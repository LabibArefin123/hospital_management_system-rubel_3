@extends('adminlte::page')

@section('title', 'Edit Role')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/edit_page/role_content_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/edit_page/role_information.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/edit_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/edit_page/permission_manager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/edit_page/permission_body.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/edit_page/permission_actions.css') }}">
@stop

@section('content_header')
    <div class="role-page-header">
        <div class="role-header-content">
            <div class="role-header-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <div>
                <h1>Edit Role</h1>
                <p>Manage permissions and update role access control.</p>
            </div>
        </div>
        <a href="{{ route('roles.index') }}" class="role-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Roles</span>
        </a>
    </div>
@stop

@section('content')
    {{-- ERROR ALERT --}}
    @include('backend.setting_management.roles_and_permission.roles.partial_layout.error_message')
    <form method="POST" action="{{ route('roles.update', $role->id) }}" data-confirm="edit">
        @csrf
        @method('PUT')
        {{-- ROLE INFO --}}
        @include('backend.setting_management.roles_and_permission.roles.partial_layout.edit_page.part_1')
        {{-- GLOBAL ACTION CARD --}}
        @include('backend.setting_management.roles_and_permission.roles.partial_layout.edit_page.part_2')

        {{-- PERMISSION SECTION --}}
        <div class="permission-manager-card">
            {{-- HEADER --}}
            @include('backend.setting_management.roles_and_permission.roles.partial_layout.edit_page.part_3')
            {{-- SCROLLABLE BODY --}}
            @include('backend.setting_management.roles_and_permission.roles.partial_layout.edit_page.part_4')
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $permissions->links('pagination::bootstrap-5') }}
        </div>

        {{-- SUBMIT --}}
        <div class="role-submit-wrapper">
            <button type="submit" class="role-submit-btn">
                <i class="fas fa-save"></i>
                <span>Update Role</span>
            </button>
        </div>
    </form>
@stop

@section('js')
    <script
        src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/edit_page/role-global-select.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/edit_page/role-global-unselect.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/edit_page/role-group-select.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/roles_and_permission/roles/edit_page/role-group-unselect.js') }}">
    </script>
@stop
