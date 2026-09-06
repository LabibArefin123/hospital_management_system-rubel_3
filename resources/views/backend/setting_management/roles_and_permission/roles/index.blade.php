@extends('adminlte::page')

@section('title', 'Role List')

@section('adminlte_css')
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/role/index_page/content_header.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/role/index_page/role_summary.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/role/index_page/role_table.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/role/index_page/role_actions.css') }}">
@stop

@section('content_header')
    <div class="role-page-header">
        <div class="role-header-content">
            <div class="role-header-icon">
                <i class="fas fa-user-shield"></i>
            </div>

            <div>
                <h1>Role Management</h1>
                <p>Manage system roles and their permission access.</p>
            </div>
        </div>

        <a href="{{ route('roles.create') }}" class="role-create-btn">
            <i class="fas fa-plus"></i>
            <span>Add New Role</span>
        </a>
    </div>
@stop

@section('content')

    {{-- ERROR / SUCCESS ALERT --}}
    @include('backend.setting_management.roles_and_permission.roles.partial_layout.error_message')

    {{-- ROLE SUMMARY --}}
    <div class="role-summary-card">
        <div class="role-summary-icon">
            <i class="fas fa-users-cog"></i>
        </div>

        <div class="role-summary-content">
            <span class="role-summary-label">Total Roles</span>
            <strong class="role-summary-count">{{ $roles->count() }}</strong>
        </div>

        <div class="role-summary-description">
            <i class="fas fa-info-circle"></i>
            <span>Manage role access and permissions from one place.</span>
        </div>
    </div>

    {{-- ROLE TABLE --}}
    <div class="role-table-card">
        <div class="role-table-header">
            <div class="role-table-title">
                <div class="role-table-title-icon">
                    <i class="fas fa-list"></i>
                </div>

                <div>
                    <h4>Role List</h4>
                    <p>View and manage all available system roles.</p>
                </div>
            </div>
        </div>

        <div class="role-table-body">
            <div class="table-responsive">
                <table id="dataTables" class="table role-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th class="role-action-column">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <span class="role-sl">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <td>
                                    <div class="role-name-wrapper">
                                        <div class="role-name-icon">
                                            <i class="fas fa-user-shield"></i>
                                        </div>

                                        <div>
                                            <span class="role-name">
                                                {{ $role->name }}
                                            </span>

                                            <small>
                                                System access role
                                            </small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="permission-count">
                                        <i class="fas fa-key"></i>

                                        {{ $role->permissions->count() }}

                                        permission{{ $role->permissions->count() !== 1 ? 's' : '' }}
                                    </span>
                                </td>

                                <td>
                                    <div class="role-action-buttons">

                                        <a href="{{ route('roles.show', $role->id) }}"
                                            class="role-action-btn role-view-btn"
                                            title="View Role">
                                            <i class="fas fa-eye"></i>
                                            <span>View</span>
                                        </a>

                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="role-action-btn role-edit-btn"
                                            title="Edit Role">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('roles.destroy', $role->id) }}"
                                            method="POST"
                                            class="role-delete-form"
                                            onsubmit="return confirm('Are you sure you want to delete this role?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="role-action-btn role-delete-btn"
                                                title="Delete Role">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop