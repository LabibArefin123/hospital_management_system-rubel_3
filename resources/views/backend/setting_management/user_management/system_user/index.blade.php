@extends('adminlte::page')

@section('title', 'System Users')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/index_page/system_user_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/index_page/system_user_total.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/index_page/system_user_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/index_page/system_user_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/index_page/system_user_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/system_user/index_page/system_user_responsive.css') }}">
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="mb-0">System Users</h1>
        <div class="d-flex align-items-center gap-2">
            {{-- Add Patient User --}}
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#patientUserModal">
                <i class="fas fa-user-plus mr-1"></i>
                Add Patient User
            </button>

            {{-- Add System User --}}
            <a href="{{ route('system_users.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-user-cog mr-1"></i>
                Add System User
            </a>
        </div>
    </div>
@stop

@section('content_header')
    <div class="system-user-header">
        <div class="system-user-header-content">
            <div>
                <h1 class="system-user-title">
                    <i class="fas fa-users mr-2"></i>
                    System Users
                </h1>

                <p class="system-user-subtitle">
                    Manage system accounts, doctors and patient users.
                </p>
            </div>

            <div class="system-user-header-actions">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientUserModal">
                    <i class="fas fa-user-plus mr-1"></i>
                    Add Patient User
                </button>

                <a href="{{ route('system_users.create') }}" class="btn btn-success">
                    <i class="fas fa-user-cog mr-1"></i>
                    Add System User
                </a>
            </div>
        </div>
    </div>
@stop

@section('content')
    {{-- USER TOTALS --}}
    @include('backend.setting_management.user_management.system_user.partials.index_page.card_box')
    {{--  USER TABLE --}}
    <div class="card system-user-card">
        <div class="card-header system-user-table-header">
            <div>
                <h5 class="mb-0 font-weight-bold">
                    <i class="fas fa-users mr-2"></i>
                    All Users
                </h5>
                <small class="text-muted">
                    Manage system users and patient accounts.
                </small>
            </div>
            <button type="button" class="btn btn-outline-primary" id="toggleSystemUserFilter">
                <i class="fas fa-filter mr-1"></i>
                <span id="systemUserFilterButtonText">Filter Users</span>
            </button>
        </div>
        @include('backend.setting_management.user_management.system_user.modal.filter_part')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table system-user-table" id="systemUsersTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Primary Phone</th>
                            <th>Alt. Phone</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'Not Provided' }}</td>
                                <td>{{ $user->phone_2 ?? 'Not Provided' }}</td>
                                <td>{{ $user->username ?? 'Not Provided' }}</td>
                                <td class="system-user-action-cell">
                                    <div class="system-user-actions">
                                        <a href="{{ route('system_users.show', $user->id) }}"
                                            class="btn btn-info btn-sm custom-action-btn">
                                            <i class="fas fa-eye"></i>
                                            <span>View</span>
                                        </a>
                                        <a href="{{ route('system_users.edit', $user->id) }}"
                                            class="btn btn-warning btn-sm custom-action-btn">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        @if (auth()->user()->hasRole('admin'))
                                            <button type="button"
                                                class="btn btn-danger btn-sm change-password-btn custom-action-btn"
                                                data-bs-toggle="modal" data-bs-target="#changePasswordModal"
                                                data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                                data-user-email="{{ $user->email ?? '' }}"
                                                data-user-role="{{ $user->roles->pluck('name')->join(', ') }}"
                                                data-user-picture="{{ $user->hasRole('doctor') && $user->doctor && $user->doctor->image ? asset($user->doctor->image) : ($user->profile_picture ? asset($user->profile_picture) : asset('uploads/images/default.jpg')) }}">
                                                <i class="fas fa-key"></i>
                                                <span>Change Password</span>
                                            </button>
                                            <form action="{{ route('system_users.destroy', $user->id) }}" method="POST"
                                                class="system-user-delete-form"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-secondary btn-sm custom-action-btn">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--  MODALS --}}

    @include('backend.setting_management.user_management.system_user.modal.appointment_user')
    @include('backend.setting_management.user_management.system_user.modal.change_password')

@stop

@section('js')
    <script>
        const systemUserDataUrl = @json(route('system_users.user_data'));
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/system_user/index_page/patient_autofill/patient_autofill_core.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/system_user/index_page/patient_autofill/patient_autofill_fields.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/system_user/index_page/patient_autofill/patient_autofill_events.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/system_user/index_page/patient_autofill/patient_autofill_reset.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/system_user/index_page/patient_autofill/patient_autofill_init.js') }}">
    </script>
    <script src="{{ asset('js/custom_backend/setting_management/system_user/index_page/system_user_password.js') }}">
    </script>
    <script
        src="{{ asset('js/custom_backend/setting_management/system_user/index_page/system_user_password_toggle.js') }}">
    </script>
    <script src="{{ asset('js/custom_backend/setting_management/system_user/index_page/system_user_table.js') }}"></script>
    <script src="{{ asset('js/custom_backend/setting_management/system_user/index_page/system_user_filter.js') }}">
    </script>
@endsection
