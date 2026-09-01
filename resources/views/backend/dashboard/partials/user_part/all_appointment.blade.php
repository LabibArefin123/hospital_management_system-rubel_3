<div class="card appointment-box">
    <div class="card-header">
        <h5 class="mb-0">My All Appointments</h5>
    </div>
    <div class="card-body table-responsive">
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
                    <th class="text-center">Action</th>
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
                        <td>
                            <div class="appointment-actions">
                                <a href="{{ route('appointments.show', $appointment->id) }}"
                                    class="btn btn-info btn-sm appointment-action-btn">
                                    <i class="fas fa-eye"></i>
                                    <span>View Appointment</span>
                                </a>

                                @if ($appointment->status === 'pending')
                                    <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST"
                                        class="d-inline appointment-cancel-form">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm appointment-action-btn"
                                            onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Cancel Appointment</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center appointment-empty">
                            <i class="fas fa-calendar-times fa-2x text-muted appointment-empty-icon"></i>
                            <div class="text-muted">You don't have any appointments yet.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
