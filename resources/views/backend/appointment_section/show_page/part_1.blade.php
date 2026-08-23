<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <small class="text-muted d-block mb-1">Appointment #{{ $appointment->id }}</small>
                <h3 class="font-weight-bold mb-2">{{ $appointment->name }}</h3>
                <div class="d-flex flex-wrap align-items-center">
                    @if ($appointment->type === 'doctor')
                        <span class="badge badge-primary px-3 py-2 mr-2"><i class="fas fa-user-md mr-1"></i>Doctor
                            Consultation</span>
                    @else
                        <span class="badge badge-info px-3 py-2 mr-2"><i class="fas fa-concierge-bell mr-1"></i>Service
                            Appointment</span>
                    @endif
                    @if ($appointment->status === 'confirmed')
                        <span class="badge badge-success px-3 py-2">Confirmed</span>
                    @elseif($appointment->status === 'cancelled')
                        <span class="badge badge-danger px-3 py-2">Cancelled</span>
                    @elseif($appointment->status === 'completed')
                        <span class="badge badge-success px-3 py-2">Completed</span>
                    @else
                        <span class="badge badge-warning px-3 py-2">Pending</span>
                    @endif
                </div>
            </div>
            <div class="text-md-right mt-3 mt-md-0">
                <small class="text-muted d-block">Appointment Date</small>
                <h5 class="font-weight-bold mb-1">
                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</h5>
                <span class="text-muted"><i
                        class="fas fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</span>
            </div>
        </div>
    </div>
</div>
