@extends('adminlte::page')

@section('title', 'Doctor Schedules')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="font-weight-bold mb-1">
                <i class="fas fa-calendar-check text-primary"></i>
                Doctor Schedules
            </h1>

            <p class="text-muted mb-0">
                Manage all doctor schedules in grouped view
            </p>
        </div>

        <a href="{{ route('doctor-schedules.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle"></i>
            Add Schedule
        </a>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/backend/schedule_management/doctor_schedule/doctor_schedule_action.css') }}">
    <div class="row">
        @forelse($doctorSchedules as $doctorSchedule)
            <div class="col-12 mb-4">
                <div class="card shadow border-0">
                    <div class="card-header bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                    style="width:60px;height:60px;">
                                    @if ($doctorSchedule['doctor'] && !empty($doctorSchedule['doctor']->image))
                                        <img src="{{ asset($doctorSchedule['doctor']->image) }}"
                                            class="img-circle elevation-2" width="55" height="55"
                                            style="object-fit:cover;" alt="{{ $doctorSchedule['doctor']->name ?? 'Doctor' }}">
                                    @else
                                        <img src="{{ asset('uploads/images/default.jpg') }}" class="img-circle elevation-2"
                                            width="55" height="55" style="object-fit:cover;" alt="Default Doctor">
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-weight-bold mb-1">{{ $doctorSchedule['doctor']->name ?? 'N/A' }}</h4>
                                    <div class="d-flex flex-wrap">
                                        <span
                                            class="badge badge-success mr-2 px-3 py-2">{{ $doctorSchedule['available_count'] }}
                                            Available</span>
                                        <span class="badge badge-danger px-3 py-2">{{ $doctorSchedule['booked_count'] }}
                                            Booked</span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-light border" data-toggle="collapse"
                                data-target="#doctorSchedule{{ $doctorSchedule['doctor_id'] }}">
                                <i class="fas fa-calendar-alt text-primary"></i>
                                View Schedule
                            </button>
                        </div>
                    </div>
                    <div id="doctorSchedule{{ $doctorSchedule['doctor_id'] }}" class="collapse show">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($doctorSchedule['schedules'] as $schedule)
                                    <div class="col-md-3 mb-3">
                                        <div
                                            class="border rounded-lg p-3 h-100 {{ $schedule->is_booked ? 'border-danger bg-light' : 'border-success bg-white' }}">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="font-weight-bold mb-2">
                                                        <i class="fas fa-calendar text-info"></i>
                                                        {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}
                                                    </h6>
                                                    <p class="mb-2">
                                                        <i class="fas fa-clock text-success"></i>
                                                        {{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}
                                                    </p>
                                                </div>
                                                <div>
                                                    @if ($schedule->is_booked)
                                                        <span class="badge badge-danger px-3 py-2">Booked</span>
                                                    @else
                                                        <span class="badge badge-success px-3 py-2">Available</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="doctor-schedule-actions">
                                                <a href="{{ route('doctor-schedules.show', $schedule->id) }}"
                                                    class="btn btn-info btn-sm doctor-schedule-action-btn">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('doctor-schedules.edit', $schedule->id) }}"
                                                    class="btn btn-warning btn-sm doctor-schedule-action-btn">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('doctor-schedules.destroy', $schedule->id) }}"
                                                    method="POST" class="doctor-schedule-action-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm doctor-schedule-action-btn"
                                                        onclick="return confirm('Delete schedule?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5 class="font-weight-bold">No Schedules Found</h5>
                        <p class="text-muted mb-0">There are no doctor schedules available.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <div style="height:5px"></div>
@stop
