<div class="appointment-section appointment-section-doctor" data-section-type="doctor">
    <div class="appointment-section-header">
        <div class="appointment-section-title">
            <div class="appointment-section-icon appointment-section-icon-doctor"><i class="fas fa-user-md"></i></div>
            <div>
                <h3>Doctor Consultations</h3>
                <p>Patient appointments with doctors.</p>
            </div>
        </div>
        <span class="appointment-section-count appointment-section-count-doctor"
            data-count="{{ $doctorAppointments->count() }}">{{ $doctorAppointments->count() }} Appointments</span>
    </div>
    <div class="row appointment-wrapper">
        @forelse($doctorAppointments as $appointment)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 appointment-card" data-type="doctor"
                data-status="{{ strtolower($appointment->status) }}"
                data-search="{{ strtolower($appointment->name . ' ' . $appointment->phone . ' ' . $appointment->doctor_name . ' ' . $appointment->doctor_speciality) }}">
                <div class="appointment-card-inner">
                    <div class="appointment-card-top">
                        <div class="appointment-type-badge appointment-type-doctor"><i class="fas fa-user-md"></i>
                            Doctor Consultation</div>
                        @if ($appointment->status == 'pending')
                            <span class="appointment-status appointment-status-pending">Pending</span>
                        @elseif($appointment->status == 'confirmed')
                            <span class="appointment-status appointment-status-confirmed">Confirmed</span>
                        @elseif($appointment->status == 'cancelled')
                            <span class="appointment-status appointment-status-cancelled">Cancelled</span>
                        @endif
                    </div>
                    <div class="appointment-patient">
                        <img src="{{ $appointment->patient_image }}" class="appointment-patient-image"
                            alt="{{ $appointment->name }}">
                        <div class="appointment-patient-info">
                            <h5>{{ $appointment->name }}</h5>
                            <span><i class="fas fa-phone-alt"></i> {{ $appointment->patient_phone }}</span>
                        </div>
                    </div>
                    <div class="appointment-patient-meta">
                        <div><span>Age</span><strong>{{ $appointment->patient_age }}</strong></div>
                        <div><span>Gender</span><strong>{{ $appointment->patient_gender }}</strong></div>
                    </div>
                    <div class="appointment-provider">
                        <img src="{{ $appointment->doctor_image }}" class="appointment-provider-image-doctor"
                            alt="{{ $appointment->doctor_name }}">
                        <div class="appointment-provider-info">
                            <span>Doctor</span>
                            <strong>{{ $appointment->doctor_name }}</strong>
                            <small>{{ $appointment->doctor_speciality }}</small>
                        </div>
                    </div>
                    <div class="appointment-details">
                        <div class="appointment-detail">
                            <i class="fas fa-calendar-alt"></i>
                            <div><span>Date</span><strong>{{ $appointment->formatted_date }}</strong></div>
                        </div>
                        <div class="appointment-detail">
                            <i class="fas fa-clock"></i>
                            <div><span>Time</span><strong>{{ $appointment->formatted_time }}</strong></div>
                        </div>
                        <div class="appointment-detail">
                            <i class="fas fa-money-bill-wave"></i>
                            <div><span>Amount</span><strong>৳ {{ $appointment->amount_formatted }}</strong></div>
                        </div>
                    </div>
                    <div class="card-footer appointment-card-footer">
                        <div class="appointment-actions">
                            <a href="{{ route('appointments.show', $appointment->id) }}"
                                class="btn btn-info btn-sm appointment-action-btn">
                                <i class="fas fa-eye"></i>
                                <span>View</span>
                            </a>
                            <a href="{{ route('appointments.cancel', $appointment->id) }}"
                                class="btn btn-secondary btn-sm appointment-action-btn">
                                <i class="fas fa-ban"></i>
                                <span>Cancel</span>
                            </a>
                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                class="appointment-action-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm appointment-action-btn"
                                    onclick="return confirm('Delete appointment?')">
                                    <i class="fas fa-trash"></i>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 appointment-empty-state">
                <i class="fas fa-user-md"></i>
                <h5>No Doctor Consultations</h5>
                <p>There are currently no doctor appointments.</p>
            </div>
        @endforelse
    </div>
    @if ($doctorAppointments->hasPages())
        <div class="appointment-pagination">
            <div class="appointment-pagination-links">
                {{ $doctorAppointments->links() }}
            </div>
        </div>
    @endif
</div>
