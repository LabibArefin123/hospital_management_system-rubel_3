@extends('adminlte::page')

@section('title', 'Service Schedules')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="font-weight-bold mb-1">
                <i class="fas fa-calendar-check text-primary"></i>
                Service Schedules
            </h1>

            <p class="text-muted mb-0">
                Manage all service schedules in grouped view
            </p>
        </div>

        <a href="{{ route('service-schedules.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle"></i>
            Add Schedule
        </a>
    </div>
@stop

@section('content')
    <link rel="stylesheet" href="{{ asset('css/backend/schedule_management/service_schedule/service_schedule_action.css') }}">
    <div class="row">
        @php
            $groupedSchedules = $schedules->groupBy('service_id');
        @endphp

        @forelse($groupedSchedules as $serviceId => $serviceSchedules)
            @php
                $service = $serviceSchedules->first()->service;
                $availableCount = $serviceSchedules->where('is_booked', 0)->count();
                $bookedCount = $serviceSchedules->where('is_booked', 1)->count();
            @endphp
            <div class="col-12 mb-4">
                <div class="card shadow border-0">
                    {{-- HEADER --}}
                    <div class="card-header bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center">
                                {{-- SERVICE ICON --}}
                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                              >
                                    <img src="{{ asset($service->image) }}" width="70" height="70"
                                        style="object-fit:cover;border-radius:8px;">
                                </div>

                                {{-- SERVICE INFORMATION --}}
                                <div>
                                    <h4 class="font-weight-bold mb-1"> {{ $service->title ?? 'N/A' }} </h4>
                                    <div class="d-flex flex-wrap">
                                        <span class="badge badge-success mr-2 px-3 py-2">{{ $availableCount }}
                                            Available</span>
                                        <span class="badge badge-danger px-3 py-2">{{ $bookedCount }} Booked</span>
                                    </div>
                                </div>
                            </div>

                            {{-- COLLAPSE BUTTON --}}
                            <button class="btn btn-light border" data-toggle="collapse"
                                data-target="#serviceSchedule{{ $serviceId }}">
                                <i class="fas fa-calendar-alt text-primary"></i>
                                View Schedule
                            </button>
                        </div>
                    </div>

                    {{-- BODY --}}
                    <div id="serviceSchedule{{ $serviceId }}" class="collapse show">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($serviceSchedules as $schedule)
                                    <div class="col-md-3 mb-3">
                                        <div
                                            class="border rounded-lg p-3 h-100
                                            {{ $schedule->is_booked ? 'border-danger bg-light' : 'border-success bg-white' }}">

                                            {{-- DATE / TIME / STATUS --}}
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

                                                {{-- STATUS --}}
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

                                            {{-- ACTIONS --}}
                                            <div class="service-schedule-actions">
                                                <a href="{{ route('service-schedules.show', $schedule->id) }}"
                                                    class="btn btn-info btn-sm service-schedule-action-btn"
                                                    title="View Schedule">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- EDIT --}}
                                                <a href="{{ route('service-schedules.edit', $schedule->id) }}"
                                                    class="btn btn-warning btn-sm service-schedule-action-btn"
                                                    title="Edit Schedule">

                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- DELETE --}}
                                                <form action="{{ route('service-schedules.destroy', $schedule->id) }}"
                                                    method="POST" class="service-schedule-action-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm service-schedule-action-btn"
                                                        title="Delete Schedule"
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
                    <i class="fas fa-calendar-times text-muted mr-2"></i>
                    No Service Schedule Found
                </div>
            </div>
        @endforelse
    </div>
    <div style="height:5px"></div>
@stop
