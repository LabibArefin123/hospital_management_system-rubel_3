@extends('adminlte::page')

@section('title', 'System Users')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="mb-0">System Users</h1>
        <a href="{{ route('system_users.create') }}" class="btn btn-success btn-sm">Add</a>
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
                                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">Change
                                            Password</button>
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

                <div class="modal fade" id="changePasswordModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow-lg">
                            <div class="modal-header">
                                <h5 class="modal-title">Change Password – <span id="modalUserName"></span></h5>
                                <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <form method="POST" id="changePasswordForm">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control"
                                                required>
                                            <div class="input-group-append">
                                                <span class="input-group-text toggle-password" data-target="password"><i
                                                        class="fas fa-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text toggle-password"
                                                    data-target="password_confirmation"><i class="fas fa-eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/setting_management/system_user/index_page/system_user_password.js') }}"></script>
    <script src="{{ asset('js/custom_backend/setting_management/system_user/index_page/system_user_password_toggle.js') }}"></script>
@endsection
