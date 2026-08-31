<div class="card appointment-box">
    <div class="card-header">
        <h5 class="mb-0">My All Appointments</h5>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover" id="dataTables">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Speciality</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>
                            <div class="appointment-doctor">
                                <div class="appointment-doctor-image">
                                    <img src="{{ $appointment->doctor?->image ? asset($appointment->doctor->image) : asset('images/default-doctor.png') }}"
                                        alt="{{ $appointment->doctor->name ?? 'Doctor' }}">
                                </div>
                                <strong
                                    class="appointment-doctor-name">{{ $appointment->doctor->name ?? 'N/A' }}</strong>
                            </div>
                        </td>
                        <td>{{ $appointment->doctor->speciality ?? 'N/A' }}</td>
                        <td>{{ ucfirst($appointment->type) }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                        <td>{{ $appointment->appointment_time }}</td>
                        <td>
                            @if ($paidAppointmentIds->contains($appointment->id))
                                <span
                                    class="appointment-amount appointment-amount-paid">৳{{ number_format($appointment->amount, 2) }}<i
                                        class="fas fa-check ml-1"></i></span>
                            @elseif($appointment->payment_method === 'Online')
                                <span
                                    class="appointment-amount appointment-amount-online">৳{{ number_format($appointment->amount, 2) }}<i
                                        class="fas fa-check-circle ml-1"></i></span>
                            @elseif($appointment->status === 'confirmed')
                                <span
                                    class="appointment-amount appointment-amount-cash-received">৳{{ number_format($appointment->amount, 2) }}<i
                                        class="fas fa-money-bill-wave ml-1"></i></span>
                            @elseif($appointment->status === 'pending')
                                <span
                                    class="appointment-amount appointment-amount-cash-pending">৳{{ number_format($appointment->amount, 2) }}<i
                                        class="fas fa-clock ml-1"></i></span>
                            @else
                                <span
                                    class="appointment-amount appointment-amount-pending">৳{{ number_format($appointment->amount, 2) }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($appointment->status === 'confirmed')
                                <span class="badge badge-success appointment-status">Confirmed</span>
                            @elseif($appointment->status === 'cancelled')
                                <span class="badge badge-danger appointment-status">Cancelled</span>
                            @else
                                <span class="badge badge-warning appointment-status">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center appointment-empty">
                            <i class="fas fa-calendar-times fa-2x text-muted appointment-empty-icon"></i>
                            <div class="text-muted">You don't have any appointments yet.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
