    <div class="card ">
        <div class="card-header bg-white">
            <h5 class="mb-0">Latest Appointments</h5>
        </div>
        <div class="card-body">
            @forelse ($latestAppointments as $appointment)
                <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <div class="mr-3" style="width:60px;height:60px;flex:0 0 60px;">
                            <img src="{{ $appointment->doctor->image ? asset($appointment->doctor->image) : asset('images/default-doctor.png') }}"
                                alt="{{ $appointment->doctor->name ?? 'Doctor' }}"
                                style="width:60px;height:60px;object-fit:cover;border-radius:6px;">
                        </div>
                        <div>
                            <strong>{{ $appointment->doctor->name ?? 'N/A' }}</strong>
                            <br>
                            <small class="text-muted">{{ ucfirst($appointment->type) }}</small>
                            @if ($appointment->appointment_date)
                                <br>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</small>
                            @endif
                        </div>
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
