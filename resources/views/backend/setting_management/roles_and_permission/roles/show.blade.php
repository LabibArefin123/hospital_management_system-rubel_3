@extends('adminlte::page')

@section('title', 'View Role')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/show_page/content_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/show_page/role_information.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/show_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/show_page/permission_groups.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/show_page/permission_cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/show_page/permission_empty.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/role/show_page/permission_actions.css') }}">
@stop

@section('content_header')
    <div class="role-page-header">
        <div class="role-header-content">
            <div class="role-header-icon">
                <i class="fas fa-user-shield"></i>
            </div>

            <div>
                <h1>Role Details</h1>
                <p>View role information and assigned access permissions.</p>
            </div>
        </div>

        <a href="{{ route('roles.index') }}" class="role-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Roles</span>
        </a>
    </div>
@stop

@section('content')

    {{-- ERROR / SUCCESS ALERT --}}
    @include('backend.setting_management.roles_and_permission.roles.partial_layout.error_message')

    {{-- ROLE INFORMATION --}}
    <div class="role-info-card">
        <div class="role-card-header">
            <div class="role-card-icon">
                <i class="fas fa-id-badge"></i>
            </div>

            <div>
                <h4>Role Information</h4>
                <p>Basic information about this system role.</p>
            </div>
        </div>

        <div class="role-card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="role-field">
                        <label for="roleName">Role Name</label>

                        <div class="role-input-wrapper">
                            <i class="fas fa-shield-alt"></i>

                            <input type="text" id="roleName" class="role-input" value="{{ $role->name }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="role-field">
                        <label for="permissionCount">Total Permissions</label>

                        <div class="role-input-wrapper">
                            <i class="fas fa-key"></i>

                            <input type="text" id="permissionCount" class="role-input"
                                value="{{ $role->permissions->count() }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PERMISSION SECTION --}}
    <div class="permission-manager-card">

        {{-- HEADER --}}
        <div class="permission-header-card">
            <div class="permission-header-content">
                <div class="permission-header-icon">
                    <i class="fas fa-key"></i>
                </div>

                <div class="permission-header-text">
                    <h4>Assigned Permissions</h4>
                    <p>Permissions currently assigned to this role.</p>
                </div>
            </div>

            <div class="permission-total-badge">
                <i class="fas fa-lock"></i>
                <span>{{ $role->permissions->count() }} Permissions</span>
            </div>
        </div>

        {{-- PERMISSION BODY --}}
        <div class="permission-manager-body">

            @forelse($groupedPermissions as $group => $permissions)

                <div class="permission-group">

                    <div class="permission-group-header">
                        <div class="permission-group-title">
                            <div class="permission-group-icon">
                                <i class="fas fa-folder-open"></i>
                            </div>

                            <div>
                                <h5>{{ ucfirst($group) }}</h5>
                                <p>
                                    {{ $permissions->count() }}
                                    permission{{ $permissions->count() !== 1 ? 's' : '' }}
                                    assigned
                                </p>
                            </div>
                        </div>

                        <span class="permission-group-count">
                            {{ $permissions->count() }}
                        </span>
                    </div>

                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-xl-4 col-lg-6 mb-3">
                                <div class="permission-box">
                                    <div class="permission-box-icon">
                                        <i class="fas fa-check"></i>
                                    </div>

                                    <div class="permission-box-content">
                                        <span>
                                            {{ $permission->name }}
                                        </span>

                                        <small>
                                            Permission granted
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (!$loop->last)
                        <hr class="permission-group-divider">
                    @endif

                </div>

            @empty

                <div class="permission-empty-state">
                    <div class="permission-empty-icon">
                        <i class="fas fa-key"></i>
                    </div>

                    <h5>No Permissions Assigned</h5>

                    <p>
                        This role does not currently have any permissions.
                    </p>

                    <a href="{{ route('roles.edit', $role->id) }}" class="permission-empty-btn">
                        <i class="fas fa-edit"></i>
                        <span>Manage Permissions</span>
                    </a>
                </div>

            @endforelse

        </div>
    </div>

    {{-- ROLE ACTIONS --}}
    <div class="role-bottom-actions">
        <a href="{{ route('roles.index') }}" class="role-secondary-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Roles</span>
        </a>

        <a href="{{ route('roles.edit', $role->id) }}" class="role-edit-btn">
            <i class="fas fa-edit"></i>
            <span>Edit Role</span>
        </a>
    </div>

@stop
