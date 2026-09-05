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

    {{-- USER TOTALS= --}}
    <div class="system-user-total-wrapper">
        {{-- ADMIN --}}
        <div class="system-user-total-card">
            <div class="system-user-total-icon admin">
                <i class="fas fa-user-shield"></i>
            </div>

            <div class="system-user-total-content">
                <span class="system-user-total-label">
                    Total Admin Users
                </span>

                <strong class="system-user-total-number">
                    {{ $userTotals['admin'] }}
                </strong>
            </div>
        </div>


        {{-- DOCTOR --}}
        <div class="system-user-total-card">
            <div class="system-user-total-icon doctor">
                <i class="fas fa-user-md"></i>
            </div>

            <div class="system-user-total-content">
                <span class="system-user-total-label">
                    Total Doctor Users
                </span>

                <strong class="system-user-total-number">
                    {{ $userTotals['doctor'] }}
                </strong>
            </div>
        </div>


        {{-- CREATED PATIENT --}}
        <div class="system-user-total-card">
            <div class="system-user-total-icon patient">
                <i class="fas fa-user-check"></i>
            </div>

            <div class="system-user-total-content">
                <span class="system-user-total-label">
                    Patient Users Created
                </span>

                <strong class="system-user-total-number">
                    {{ $userTotals['patient_created'] }}
                </strong>
            </div>
        </div>


        {{-- NOT CREATED PATIENT --}}
        <div class="system-user-total-card">
            <div class="system-user-total-icon pending">
                <i class="fas fa-user-clock"></i>
            </div>

            <div class="system-user-total-content">
                <span class="system-user-total-label">
                    Patient Users Not Created
                </span>

                <strong class="system-user-total-number">
                    {{ $userTotals['patient_not_created'] }}
                </strong>
            </div>
        </div>
    </div>


    {{--  USER TABLE --}}
    <div class="card system-user-card">
        <div class="card-header system-user-table-header">
            <div>
                <h5 class="mb-0 font-weight-bold">
                    <i class="fas fa-users mr-2"></i>
                    All Users
                </h5>

                <small class="text-muted">
                    Filter users by role
                </small>
            </div>


            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#systemUserFilterModal">

                <i class="fas fa-filter mr-1"></i>
                Filter Users
                <span id="activeFilterBadge" class="badge badge-primary ml-1 d-none">
                    1
                </span>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table system-user-table" id="systemUsersTable" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone 1</th>
                            <th>Phone 2</th>
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
                                <td class="text-nowrap">
                                    <a href="{{ route('system_users.show', $user->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('system_users.edit', $user->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    @if (auth()->user()->hasRole('admin'))
                                        <button type="button" class="btn btn-danger btn-sm change-password-btn"
                                            data-bs-toggle="modal" data-bs-target="#changePasswordModal"
                                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                            data-user-email="{{ $user->email ?? '' }}"
                                            data-user-role="{{ $user->roles->pluck('name')->join(', ') }}"
                                            data-user-picture="{{ $user->hasRole('doctor') && $user->doctor && $user->doctor->image ? asset($user->doctor->image) : ($user->profile_picture ? asset($user->profile_picture) : asset('uploads/images/default.jpg')) }}">
                                            <i class="fas fa-key mr-1"></i>
                                            Change Password
                                        </button>
                                        <form action="{{ route('system_users.destroy', $user->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--  MODALS --}}
    @include('backend.setting_management.user_management.system_user.modal.filter_part')
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
