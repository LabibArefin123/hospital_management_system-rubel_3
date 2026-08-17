@extends('adminlte::page')

@section('title', 'Permissions List')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Permissions List</h1>
        @if (auth()->user()->hasRole('admin'))
            <button type="button" id="delete-selected" class="btn btn-danger btn-sm ms-2" title="Delete Selected">
                <i class="fas fa-trash-alt me-1"></i> Delete Selected
            </button>
        @endif
    </div>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input.</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- Add Permission Form -->
            <form method="POST" action="{{ route('permissions.store') }}">
                @csrf
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Add New Permission</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Enter permission name" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Permission</button>
                    </div>
                </div>
            </form>

            <!-- Permissions Table -->
            <table id="dataTables" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>SL</th>
                        <th>Permission Name</th>
                        <th class="text-center">Guard</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" class="row-checkbox" value="{{ $permission->id }}">
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="text-center">{{ $permission->guard_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                        class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('js')
    <script>
        const permissionsDeleteUrl = "{{ route('permissions.deleteSelected') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/custom_backend/setting_management/roles_and_permission/permission/index.js') }}"></script>
@endsection
