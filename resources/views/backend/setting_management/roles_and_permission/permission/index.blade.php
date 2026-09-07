@extends('adminlte::page')

@section('title', 'Permissions List')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/permission/index_page/permission_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/permission/index_page/permission_total.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/permission/index_page/permission_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/setting_management/permission/index_page/permission_table.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/setting_management/permission/index_page/permission_responsive.css') }}">
@stop

@section('content_header')
    <div class="permission-page-header">
        <div class="permission-page-header-content">
            <div class="permission-page-title-wrapper">
                <div class="permission-page-icon">
                    <i class="fas fa-key"></i>
                </div>
                <div>
                    <h1 class="permission-page-title">Permissions</h1>
                    <p class="permission-page-subtitle">
                        Manage system permissions and access controls.
                    </p>
                </div>
            </div>

            @if (auth()->user()->hasRole('admin'))
                <button type="button" id="delete-selected" class="permission-delete-selected-btn" title="Delete Selected"
                    style="display: none;">
                    <i class="fas fa-trash-alt"></i>
                    <span>Delete Selected</span>
                </button>
            @endif
        </div>
    </div>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger permission-error-alert">
            <div class="permission-error-title">
                <i class="fas fa-exclamation-circle"></i>
                <strong>There were some problems with your input.</strong>
            </div>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="permission-page-wrapper">

        {{-- TOTAL / SELECTION SUMMARY --}}
        <div class="permission-summary-card">
            <div class="permission-summary-left">
                <div class="permission-summary-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>

                <div class="permission-summary-content">
                    <span class="permission-summary-label">
                        Permission Selection
                    </span>

                    <div class="permission-summary-count">
                        <span id="selectedPermissionCount">0</span>
                        <span>selected</span>
                        <span class="permission-summary-separator">of</span>
                        <span id="totalPermissionCount">{{ $permissions->count() }}</span>
                        <span>permissions</span>
                    </div>
                </div>
            </div>

            <div class="permission-summary-status" id="permissionSelectionStatus">
                <i class="fas fa-check-circle"></i>
                <span>No permissions selected</span>
            </div>
        </div>

        {{-- ADD PERMISSION --}}
        <div class="permission-form-card">
            <div class="permission-card-header">
                <div class="permission-card-heading">
                    <div class="permission-card-icon">
                        <i class="fas fa-plus"></i>
                    </div>

                    <div>
                        <h5>Add New Permission</h5>
                        <p>Create a new system permission.</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('permissions.store') }}">
                @csrf

                <div class="permission-form-body">
                    <div class="permission-form-group">
                        <label for="name">
                            Permission Name
                            <span class="text-danger">*</span>
                        </label>

                        <div class="permission-input-wrapper">
                            <i class="fas fa-lock permission-input-icon"></i>
                            <input type="text" class="form-control permission-name-input" name="name" id="name"
                                value="{{ old('name') }}" placeholder="Enter permission name" autocomplete="off">
                        </div>

                        <small class="permission-form-help">
                            Use a clear name such as
                            <strong>view patients</strong> or
                            <strong>manage appointments</strong>.
                        </small>
                    </div>
                </div>

                <div class="permission-form-footer">
                    <button type="submit" class="permission-save-btn">
                        <i class="fas fa-save"></i>
                        <span>Save Permission</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- PERMISSIONS TABLE --}}
        <div class="permission-table-card">

            <div class="permission-table-header">
                <div class="permission-table-heading">
                    <div class="permission-table-icon">
                        <i class="fas fa-list"></i>
                    </div>

                    <div>
                        <h5>All Permissions</h5>
                        <p>View and manage available system permissions.</p>
                    </div>
                </div>

                <div class="permission-table-total">
                    <span id="permissionTableTotal">
                        {{ $permissions->count() }}
                    </span>
                    <span>Permissions</span>
                </div>
            </div>

            <div class="permission-table-wrapper">
                <table id="dataTables" class="table permission-table">

                    <thead>
                        <tr>
                            <th class="permission-checkbox-column">
                                <div class="permission-select-all-wrapper">
                                    <input type="checkbox" id="select-all" class="permission-checkbox"
                                        title="Select all permissions">

                                    <label for="select-all"></label>
                                </div>
                            </th>

                            <th class="permission-sl-column">
                                SL
                            </th>

                            <th>
                                Permission Name
                            </th>

                            <th class="text-center">
                                Guard
                            </th>

                            <th class="text-center permission-action-column">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="text-center">
                                    <div class="permission-row-checkbox-wrapper">
                                        <input type="checkbox" class="row-checkbox permission-checkbox"
                                            value="{{ $permission->id }}" id="permission-{{ $permission->id }}">

                                        <label for="permission-{{ $permission->id }}"></label>
                                    </div>
                                </td>

                                <td>
                                    <span class="permission-sl">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>

                                <td>
                                    <div class="permission-name-cell">
                                        <div class="permission-name-icon">
                                            <i class="fas fa-key"></i>
                                        </div>

                                        <span>
                                            {{ $permission->name }}
                                        </span>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <span class="permission-guard-badge">
                                        <i class="fas fa-shield-alt"></i>
                                        {{ $permission->guard_name }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="permission-action-buttons">

                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                            class="permission-edit-btn">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                            class="permission-delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Are you sure you want to delete this permission?')"
                                                type="submit" class="permission-delete-btn">
                                                <i class="fas fa-trash"></i>
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

@section('js')
    <script>
        const permissionsDeleteUrl = "{{ route('permissions.deleteSelected') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>

    <script
        src="{{ asset('js/custom_backend/setting_management/roles_and_permission/permission/permission_selection.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/roles_and_permission/permission/permission_counter.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/roles_and_permission/permission/permission_bulk_delete.js') }}">
    </script>
    <script src="{{ asset('js/custom_backend/setting_management/roles_and_permission/permission/index.js') }}"></script>
@endsection
