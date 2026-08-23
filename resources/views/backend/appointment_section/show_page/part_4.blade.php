<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0">
        <h4 class="font-weight-bold mb-0"><i class="fas fa-file-invoice-dollar text-success mr-2"></i>Appointment &
            Payment Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="p-3 bg-light rounded h-100">
                    <small class="text-muted d-block mb-1">Appointment Date</small>
                    <strong><i
                            class="fas fa-calendar text-primary mr-1"></i>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</strong>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-3 bg-light rounded h-100">
                    <small class="text-muted d-block mb-1">Appointment Time</small>
                    <strong><i
                            class="fas fa-clock text-info mr-1"></i>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</strong>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-3 bg-light rounded h-100">
                    <small class="text-muted d-block mb-1">Appointment Type</small>
                    @if ($appointment->type === 'doctor')
                        <strong><i class="fas fa-user-md text-primary mr-1"></i>Doctor Consultation</strong>
                    @else
                        <strong><i class="fas fa-concierge-bell text-info mr-1"></i>Service</strong>
                    @endif
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <small class="text-muted d-block">Payment Method</small>
                <strong>{{ $appointment->payment_method ?? 'N/A' }}</strong>
            </div>
            <div class="col-md-4 mb-3">
                <small class="text-muted d-block">Amount</small>
                <strong class="text-success">৳ {{ number_format($appointment->amount ?? 0, 2) }}</strong>
            </div>
            <div class="col-md-4 mb-3">
                <small class="text-muted d-block">Status</small>
                @if ($appointment->status === 'confirmed')
                    <span class="badge badge-success px-3 py-2">Confirmed</span>
                @elseif($appointment->status === 'cancelled')
                    <span class="badge badge-danger px-3 py-2">Cancelled</span>
                @elseif($appointment->status === 'completed')
                    <span class="badge badge-primary px-3 py-2">Completed</span>
                @else
                    <span class="badge badge-warning px-3 py-2">Pending</span>
                @endif
            </div>
        </div>
    </div>
</div>
