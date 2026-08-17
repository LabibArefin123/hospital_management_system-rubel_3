@extends('adminlte::page')

@section('title', 'Doctors')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-dark font-weight-bold">
            <i class="fas fa-user-md text-primary"></i> Doctor Management
        </h1>

        <a href="{{ route('doctors.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle"></i> Add Doctor
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover align-middle" id="datatables">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Speciality</th>
                        <th>Experience</th>
                        <th>Patients</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($doctor->image)
                                    <img src="{{ asset($doctor->image) }}" class="img-circle elevation-2" width="55"
                                        height="55" style="object-fit: cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}"
                                        class="img-circle" width="55">
                                @endif
                            </td>
                            <td>
                                <strong>{{ $doctor->name }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $doctor->qualification }}
                                </small>
                            </td>
                            <td>
                                <span class="badge badge-info px-3 py-2">
                                    {{ $doctor->speciality }}
                                </span>
                            </td>
                            <td>
                                {{ $doctor->experience_years }} Years
                            </td>
                            <td>
                                {{ $doctor->total_patients }}+
                            </td>
                            <td>
                                ৳ {{ number_format($doctor->consultation_fee, 2) }}
                            </td>
                            <td>
                                @if ($doctor->availability == 'Available')
                                    <span class="badge badge-success px-3 py-2">
                                        Available
                                    </span>
                                @else
                                    <span class="badge badge-danger px-3 py-2">
                                        Unavailable
                                    </span>
                                @endif
                            </td>
                            <td>

                                {{-- ADMIN CAN SEE ALL --}}
                                @role('admin')
                                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this doctor?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endrole

                                {{-- DOCTOR CAN ONLY SEE VIEW --}}
                                @role('doctor')
                                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endrole
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <h5 class="text-muted">
                                    No Doctors Found
                                </h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@stop
