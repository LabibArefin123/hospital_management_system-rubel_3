@extends('adminlte::page')

@section('title', 'Appointment Details')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h1 class="font-weight-bold">
            <i class="fas fa-calendar-check text-primary"></i>
            Appointment Details
        </h1>

        <a href="{{ route('appointments.index') }}" class="btn btn-secondary shadow-sm">

            <i class="fas fa-arrow-left"></i>
            Back

        </a>

    </div>

@stop

@section('content')

    <div class="row">

        <!-- LEFT SIDE -->
        <div class="col-md-4">

            <!-- Patient Card -->
            <div class="card card-primary card-outline shadow">

                <div class="card-body box-profile text-center">

                    <div class="mb-3">

                        <img src="https://ui-avatars.com/api/?name={{ urlencode($appointment->name) }}&background=0D8ABC&color=fff"
                            class="img-circle elevation-2" width="120" height="120">

                    </div>

                    <h3 class="profile-username">

                        {{ $appointment->name }}

                    </h3>

                    <p class="text-muted">

                        {{ ucfirst($appointment->gender) }}

                    </p>

                    @if ($appointment->status == 'pending')
                        <span class="badge badge-warning px-4 py-2">
                            Pending
                        </span>
                    @elseif($appointment->status == 'confirmed')
                        <span class="badge badge-success px-4 py-2">
                            Confirmed
                        </span>
                    @elseif($appointment->status == 'cancelled')
                        <span class="badge badge-danger px-4 py-2">
                            Cancelled
                        </span>
                    @endif

                </div>

            </div>

            <!-- Contact Info -->
            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h3 class="card-title font-weight-bold">
                        Contact Information
                    </h3>

                </div>

                <div class="card-body">

                    <strong>
                        <i class="fas fa-phone-alt text-success mr-2"></i>
                        Phone
                    </strong>

                    <p class="text-muted">
                        {{ $appointment->phone }}
                    </p>

                    <hr>

                    <strong>
                        <i class="fas fa-envelope text-primary mr-2"></i>
                        Email
                    </strong>

                    <p class="text-muted">
                        {{ $appointment->email ?? 'N/A' }}
                    </p>

                    <hr>

                    <strong>
                        <i class="fas fa-user text-info mr-2"></i>
                        Age
                    </strong>

                    <p class="text-muted">
                        {{ $appointment->age ?? 'N/A' }}
                    </p>

                </div>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-md-8">

            <!-- Statistics -->
            <div class="row">

                <div class="col-md-4">

                    <div class="small-box bg-info shadow">

                        <div class="inner">

                            <h4>
                                {{ ucfirst($appointment->type) }}
                            </h4>

                            <p>Appointment Type</p>

                        </div>

                        <div class="icon">
                            <i class="fas fa-notes-medical"></i>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="small-box bg-success shadow">

                        <div class="inner">

                            <h4>
                                ৳ {{ number_format($appointment->amount, 2) }}
                            </h4>

                            <p>Consultation Fee</p>

                        </div>

                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="small-box bg-primary shadow">

                        <div class="inner">

                            <h4>
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                            </h4>

                            <p>Appointment Time</p>

                        </div>

                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Appointment Details -->
            <div class="card shadow border-0">

                <div class="card-header bg-white">

                    <h3 class="card-title font-weight-bold">

                        Appointment Information

                    </h3>

                </div>

                <div class="card-body p-0">

                    <table class="table table-bordered mb-0">

                        <tr>
                            <th width="250">Appointment Date</th>

                            <td>
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Appointment Time</th>

                            <td>
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Doctor</th>

                            <td>

                                @if ($appointment->doctor)
                                    Dr. {{ $appointment->doctor->name }}
                                @else
                                    N/A
                                @endif

                            </td>
                        </tr>

                        <tr>
                            <th>Service</th>

                            <td>

                                @if ($appointment->service)
                                    {{ $appointment->service->title }}
                                @else
                                    N/A
                                @endif

                            </td>
                        </tr>

                        <tr>
                            <th>Payment Method</th>

                            <td>

                                <span class="badge badge-dark px-3 py-2">

                                    {{ ucfirst($appointment->payment_method) }}

                                </span>

                            </td>
                        </tr>

                        <tr>
                            <th>Status</th>

                            <td>

                                @if ($appointment->status == 'pending')
                                    <span class="badge badge-warning px-3 py-2">
                                        Pending
                                    </span>
                                @elseif($appointment->status == 'confirmed')
                                    <span class="badge badge-success px-3 py-2">
                                        Confirmed
                                    </span>
                                @elseif($appointment->status == 'cancelled')
                                    <span class="badge badge-danger px-3 py-2">
                                        Cancelled
                                    </span>
                                @endif

                            </td>

                        </tr>

                        <tr>
                            <th>Created At</th>

                            <td>
                                {{ $appointment->created_at->format('d M Y h:i A') }}
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

            <!-- Action Buttons -->
            <div class="text-right mt-3">

                @if ($appointment->status != 'cancelled')
                    <a href="{{ route('appointments.cancel', $appointment->id) }}"
                        class="btn btn-secondary px-4 shadow-sm">

                        <i class="fas fa-ban"></i>
                        Cancel Appointment

                    </a>
                @endif

                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger px-4 shadow-sm"
                        onclick="return confirm('Delete appointment permanently?')">

                        <i class="fas fa-trash"></i>
                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

@stop
