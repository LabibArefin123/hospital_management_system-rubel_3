@extends('adminlte::page')

@section('title', 'Doctors')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/index_page/doctor_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/index_page/doctor_profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/index_page/doctor_index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/index_page/doctor_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/doctor_page/index_page/doctor_actions.css') }}">
@endsection

@section('content_header')
    <div class="doctor-page-header">
        <div class="doctor-header-content">
            <div class="doctor-header-icon">
                <i class="fas fa-user-md"></i>
            </div>

            <div>
                <h1>Doctor Management</h1>
                <p>Manage doctors, profiles, availability, and schedules.</p>
            </div>
        </div>

        <a href="{{ route('doctors.create') }}" class="doctor-add-btn">
            <i class="fas fa-plus"></i>
            <span>Add Doctor</span>
        </a>
    </div>
@stop

@section('content')
    {{-- This is for doctor management --}}
    <div class="row">
        <div class="col-12">
            <div class="doctor-table-card">
                <div class="doctor-table-header">
                    <div>
                        <h3>
                            <i class="fas fa-user-md"></i>
                            All Doctors
                        </h3>
                        <p>View and manage registered doctors</p>
                    </div>

                    <span class="doctor-count-badge">
                        <i class="fas fa-users"></i>
                        {{ $doctors->count() }} Doctors
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table doctor-table" id="dataTables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doctor</th>
                                <th>Speciality</th>
                                <th>Experience</th>
                                <th>Patients</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th width="210">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($doctors as $doctor)
                                <tr>

                                    <td>
                                        <span class="doctor-row-number">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="doctor-profile-cell">

                                            <div class="doctor-image-frame">
                                                @if ($doctor->image)
                                                    <img src="{{ asset($doctor->image) }}" alt="{{ $doctor->name }}">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}"
                                                        alt="{{ $doctor->name }}">
                                                @endif
                                            </div>

                                            <div class="doctor-profile-info">
                                                <strong>{{ $doctor->name }}</strong>

                                                <small>
                                                    {{ $doctor->qualification ?: 'Qualification not available' }}
                                                </small>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <span class="doctor-speciality">
                                            {{ $doctor->speciality }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="doctor-info-value">
                                            {{ $doctor->experience_years }}
                                            <small>Years</small>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="doctor-info-value">
                                            {{ $doctor->total_patients }}+
                                        </span>
                                    </td>

                                    <td>
                                        <strong class="doctor-fee">
                                            ৳ {{ number_format($doctor->consultation_fee, 2) }}
                                        </strong>
                                    </td>

                                    <td>
                                        @if ($doctor->availability == 'Available')
                                            <span class="doctor-status doctor-status-available">
                                                <span class="doctor-status-dot"></span>
                                                Available
                                            </span>
                                        @else
                                            <span class="doctor-status doctor-status-unavailable">
                                                <span class="doctor-status-dot"></span>
                                                Unavailable
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="doctor-actions">

                                            {{-- This is for admin actions --}}
                                            @role('admin')
                                                <a href="{{ route('doctors.show', $doctor->id) }}"
                                                    class="doctor-action-btn doctor-view-btn" title="View Doctor">
                                                    <i class="fas fa-eye"></i>
                                                    <span>View</span>
                                                </a>

                                                <a href="{{ route('doctors.edit', $doctor->id) }}"
                                                    class="doctor-action-btn doctor-edit-btn" title="Edit Doctor">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>

                                                <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="doctor-action-btn doctor-delete-btn"
                                                        title="Delete Doctor" onclick="return confirm('Delete this doctor?')">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            @endrole

                                            {{-- This is for doctor actions --}}
                                            @role('doctor')
                                                <a href="{{ route('doctors.show', $doctor->id) }}"
                                                    class="doctor-action-btn doctor-view-btn" title="View Doctor">
                                                    <i class="fas fa-eye"></i>
                                                    <span>View</span>
                                                </a>

                                                <a href="{{ route('doctors.edit', $doctor->id) }}"
                                                    class="doctor-action-btn doctor-edit-btn" title="Edit Doctor">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                            @endrole

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="doctor-empty-state">
                                            <div class="doctor-empty-icon">
                                                <i class="fas fa-user-md"></i>
                                            </div>

                                            <strong>No Doctors Found</strong>

                                            <span>
                                                There are currently no doctors to display.
                                            </span>

                                            <a href="{{ route('doctors.create') }}" class="doctor-empty-btn">
                                                <i class="fas fa-plus"></i>
                                                Add Doctor
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop
