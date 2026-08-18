@extends('adminlte::page')

@section('title', 'User Dashboard')

@section('content')

    <div class="container py-4">

        {{-- ================= USER HEADER ================= --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body d-flex align-items-center">

                {{-- LEFT CONTENT --}}
                <div class="flex-grow-1">
                    <h4 class="mb-1">
                        Welcome, {{ $user->name }}
                    </h4>

                    <small class="text-muted">
                        {{ $user->email }}
                    </small>
                </div>

                {{-- RIGHT AVATAR --}}
                <div class="ms-auto">
                    @if ($user->avatar ?? false)
                        <img src="{{ $user->avatar }}" class="rounded-circle border shadow-sm"
                            style="width:60px;height:60px;object-fit:cover;">
                    @else
                        <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('uploads/images/default.jpg') }}"
                            class="rounded-circle border shadow-sm" style="width:60px;height:60px;object-fit:cover;">
                    @endif
                </div>

            </div>
        </div>

        {{-- ================= STATS ================= --}}
        <div class="row">

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h3>{{ $totalAppointments }}</h3>
                        <p class="mb-0">Total Appointments</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center text-success">
                        <h3>{{ $confirmedAppointments }}</h3>
                        <p class="mb-0">Confirmed</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center text-warning">
                        <h3>{{ $pendingAppointments }}</h3>
                        <p class="mb-0">Pending</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center text-danger">
                        <h3>{{ $cancelledAppointments }}</h3>
                        <p class="mb-0">Cancelled</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ================= PAYMENT ================= --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5>Total Paid</h5>
                <h3 class="text-success">৳{{ number_format($totalPaid, 2) }}</h3>
            </div>
        </div>

        {{-- ================= LATEST APPOINTMENTS ================= --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <h5 class="mb-0">Latest Appointments</h5>
            </div>

            <div class="card-body">

                @forelse ($latestAppointments as $appointment)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                        <div>
                            <strong>
                                {{ $appointment->doctor->name ?? 'N/A' }}
                            </strong>
                            <br>

                            <small class="text-muted">
                                {{ ucfirst($appointment->type) }}
                            </small>

                            @if ($appointment->appointment_date)
                                <br>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                </small>
                            @endif
                        </div>

                        <div class="text-right">
                            <span
                                class="badge
                        @if ($appointment->status == 'confirmed') badge-success
                        @elseif($appointment->status == 'cancelled')
                            badge-danger
                        @else
                            badge-warning @endif">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">No appointments found.</p>
                    </div>
                @endforelse

            </div>

        </div>

        {{-- ================= ALL APPOINTMENTS ================= --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">
                <h5 class="mb-0">My All Appointments</h5>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover mb-0">

                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($appointments as $appointment)
                            <tr>

                                <td>
                                    <strong>
                                        {{ $appointment->doctor->name ?? 'N/A' }}
                                    </strong>
                                </td>

                                <td>
                                    {{ ucfirst($appointment->type) }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                </td>

                                <td>
                                    {{ $appointment->appointment_time }}
                                </td>

                                <td>
                                    ৳{{ number_format($appointment->amount, 2) }}
                                </td>

                                <td>
                                    <span
                                        class="badge
                                @if ($appointment->status == 'confirmed') badge-success
                                @elseif($appointment->status == 'cancelled')
                                    badge-danger
                                @else
                                    badge-warning @endif">

                                        {{ ucfirst($appointment->status) }}

                                    </span>
                                </td>

                            </tr>
                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                                    <div class="text-muted mt-2">
                                        You don't have any appointments yet.
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
