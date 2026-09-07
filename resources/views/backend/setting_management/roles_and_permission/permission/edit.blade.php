@extends('adminlte::page')

@section('title', 'Edit Permission')

@section('adminlte_css')
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/permission/edit_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/permission/edit_page/permission_form.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/permission/edit_page/permission_actions.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/permission/edit_page/permission_resp.css') }}">
@stop

@section('content_header')
    <div class="permission-edit-header">
        <div class="permission-edit-header-content">
            <div class="permission-edit-title-wrapper">
                <div class="permission-edit-icon">
                    <i class="fas fa-key"></i>
                </div>

                <div>
                    <h1 class="permission-edit-title">
                        Update Permission
                    </h1>

                    <p class="permission-edit-subtitle">
                        Modify the permission name and guard settings.
                    </p>
                </div>
            </div>

            <a href="{{ route('permissions.index') }}" class="permission-back-btn">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Permissions</span>
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid permission-edit-container">

        @if ($errors->any())
            <div class="alert alert-danger permission-edit-error">
                <div class="permission-edit-error-title">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>Please check the following errors.</strong>
                </div>

                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="permission-edit-card">

            <div class="permission-edit-card-header">
                <div class="permission-edit-card-heading">
                    <div class="permission-edit-card-icon">
                        <i class="fas fa-edit"></i>
                    </div>

                    <div>
                        <h5>Edit Permission</h5>
                        <p>
                            Update the information for this permission.
                        </p>
                    </div>
                </div>

                <span class="permission-edit-id">
                    #{{ $permission->id }}
                </span>
            </div>

            <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                @method('PUT')
                @csrf

                <div class="permission-edit-form-body">

                    <div class="permission-edit-form-group">
                        <label for="name">
                            Permission Name
                            <span class="text-danger">*</span>
                        </label>

                        <div class="permission-edit-input-wrapper">
                            <i class="fas fa-lock permission-edit-input-icon"></i>

                            <input type="text" name="name" id="name" class="form-control permission-edit-input"
                                placeholder="Enter permission name" value="{{ old('name', $permission->name) }}"
                                autocomplete="off" required>
                        </div>

                        <small class="permission-edit-help">
                            Enter a clear and descriptive permission name.
                        </small>
                    </div>

                    <div class="permission-edit-form-group">
                        <label for="guard_name">
                            Guard
                            <span class="text-danger">*</span>
                        </label>

                        <div class="permission-edit-input-wrapper">
                            <i class="fas fa-shield-alt permission-edit-input-icon"></i>

                            <input type="text" name="guard_name" id="guard_name"
                                class="form-control permission-edit-input" placeholder="Enter guard name"
                                value="{{ old('guard_name', $permission->guard_name) }}" autocomplete="off" required>
                        </div>

                        <small class="permission-edit-help">
                            Specify the authentication guard used by this permission.
                        </small>
                    </div>

                </div>

                <div class="permission-edit-card-footer">

                    <a href="{{ route('permissions.index') }}" class="permission-edit-cancel-btn">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>

                    <button type="submit" class="permission-update-btn">
                        <i class="fas fa-save"></i>
                        <span>Update Permission</span>
                    </button>

                </div>

            </form>
        </div>

    </div>
@stop
