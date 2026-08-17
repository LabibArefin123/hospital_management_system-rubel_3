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

    <div class="row">

        @php
            $groupedSchedules = $schedules->groupBy('doctor_id');
        @endphp

        @forelse($groupedSchedules as $doctorId => $doctorSchedules)

            @php
                $doctor = $doctorSchedules->first()->doctor;
                $availableCount = $doctorSchedules->where('is_booked', 0)->count();
                $bookedCount = $doctorSchedules->where('is_booked', 1)->count();
            @endphp

            <div class="col-12 mb-4">

                <div class="card shadow border-0">

                    {{-- HEADER --}}
                    <div class="card-header bg-white border-0">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div class="d-flex align-items-center">

                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                                    style="width:60px;height:60px;">
                                    @if ($doctor->image)
                                        <img src="{{ asset($doctor->image) }}" class="img-circle elevation-2" width="55"
                                            height="55" style="object-fit: cover;">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}"
                                            class="img-circle" width="55">
                                    @endif

                                </div>

                                <div>

                                    <h4 class="font-weight-bold mb-1">
                                        {{ $doctor->name ?? 'N/A' }}
                                    </h4>

                                    <div class="d-flex flex-wrap">

                                        <span class="badge badge-success mr-2 px-3 py-2">
                                            {{ $availableCount }} Available
                                        </span>

                                        <span class="badge badge-danger px-3 py-2">
                                            {{ $bookedCount }} Booked
                                        </span>

                                    </div>

                                </div>

                            </div>

                            <button class="btn btn-light border" data-toggle="collapse"
                                data-target="#doctorSchedule{{ $doctorId }}">

                                <i class="fas fa-calendar-alt text-primary"></i>
                                View Schedule

                            </button>

                        </div>

                    </div>

                    {{-- BODY --}}
                    <div id="doctorSchedule{{ $doctorId }}" class="collapse show">

                        <div class="card-body">

                            <div class="row">

                                @foreach ($doctorSchedules as $schedule)
                                    <div class="col-md-3 mb-3">

                                        <div
                                            class="border rounded-lg p-3 h-100
                                            {{ $schedule->is_booked ? 'border-danger bg-light' : 'border-success bg-white' }}">

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
                                                        <span class="badge badge-danger px-3 py-2">
                                                            Booked
                                                        </span>
                                                    @else
                                                        <span class="badge badge-success px-3 py-2">
                                                            Available
                                                        </span>
                                                    @endif

                                                </div>

                                            </div>

                                            <hr>

                                            <div class="d-flex justify-content-between">

                                                <a href="{{ route('doctor-schedules.show', $schedule->id) }}"
                                                    class="btn btn-info btn-sm">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('doctor-schedules.edit', $schedule->id) }}"
                                                    class="btn btn-warning btn-sm">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <form action="{{ route('doctor-schedules.destroy', $schedule->id) }}"
                                                    method="POST" class="d-inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm"
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

                <div class="alert alert-light shadow-sm text-center">

                    No Doctor Schedule Found

                </div>

            </div>

        @endforelse

    </div>

@stop
