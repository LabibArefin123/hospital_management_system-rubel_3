@extends('adminlte::page')

@section('title', 'System Users')

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

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTables">
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


                @include('backend.setting_management.user_management.system_user.modal.patient_user')
                @include('backend.setting_management.user_management.system_user.modal.change_password')
            </div>
        </div>
    </div>
@stop

@section('js')
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
@endsection
