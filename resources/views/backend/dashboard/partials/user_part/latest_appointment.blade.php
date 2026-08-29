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
