@extends('adminlte::page')

@section('title', 'User Dashboard')

@section('content_header')
    @include('backend.dashboard.custom_header.user')
@stop


@section('content')

    <div class="container py-4">
        {{-- ================= STATS ================= --}}
        @include('backend.dashboard.partials.user_part.user-card-box')

        {{-- ================= PAYMENT ================= --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5>Total Paid</h5>
                <h3 class="text-success">৳{{ number_format($totalPaid, 2) }}</h3>
            </div>
        </div>

        {{-- ================= LATEST APPOINTMENTS ================= --}}
        @include('backend.dashboard.partials.user_part.latest_appointment')

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
