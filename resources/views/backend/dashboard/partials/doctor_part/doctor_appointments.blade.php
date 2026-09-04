@if ($doctorAppointments->count())
    <div class="col-12 mb-4">
        <div class="appointment-section-header">
            <div class="appointment-section-title">
                <div class="appointment-section-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="appointment-section-info">
                    <h4>Doctor Consultations</h4>
                    <p>Manage and review your doctor appointments</p>
                </div>
            </div>
            <div class="appointment-section-count" id="doctorAppointmentCount">
                <i class="fas fa-calendar-check"></i>
                <span>{{ $doctorAppointments->total() }} Appointments</span>
            </div>
        </div>
    </div>
    @foreach ($doctorAppointments as $appointment)
        <div class="col-lg-3 col-md-6 mb-4 appointment-card" data-type="doctor"
            data-patient="{{ strtolower($appointment->name) }}" data-status="{{ strtolower($appointment->status) }}"
            data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}"
            data-search="{{ strtolower($appointment->name . ' ' . ($appointment->doctor->name ?? '') . ' ' . ($appointment->doctor->speciality ?? '')) }}">

            <div class="card shadow-sm border-0 h-100 rounded-lg">
                <div class="card-body">
                    {{-- PATIENT --}}
                    <div class="mb-3">
                        <h5 class="font-weight-bold mb-1">{{ $appointment->name }}</h5>
                        <p class="mb-0 text-muted">
                            {{ $appointment->age }} Years, {{ ucfirst($appointment->gender) }}
                        </p>
                    </div>

                    <div class="d-flex align-items-center mb-3 p-2 rounded" style="background:#f8f9ff;">
                        {{-- IMAGE --}}
                        <div class="mr-3">
                            <img src="{{ asset($appointment->doctor->image ?? 'images/default-doctor.png') }}"
                                style="
                            width:55px;
                            height:55px;
                            border-radius:50%;
                            object-fit:cover;
                            border:2px solid #0d6efd;
                         ">
                        </div>

                        {{-- DOCTOR INFO --}}
                        <div class="flex-grow-1">
                            <div class="font-weight-bold">
                                {{ $appointment->doctor->name }}
                            </div>

                            <small class="text-muted">
                                {{ $appointment->doctor->speciality ?? 'N/A' }}
                            </small>
                        </div>
                    </div>

                    {{-- DATE + TIME --}}
                    <div class="d-flex justify-content-between mb-3 text-muted small">
                        <span>
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                        </span>

                        <span>
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </span>
                    </div>

                    {{-- AMOUNT --}}
                    <h5 class="text-success font-weight-bold mb-3">
                        ৳{{ number_format($appointment->amount, 2) }}
                    </h5>

                </div>

                <div class="card-footer bg-white border-0 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @if ($appointment->status == 'confirmed')
                                <span class="badge badge-success px-3 py-2">Confirmed</span>
                            @elseif($appointment->status == 'cancelled')
                                <span class="badge badge-danger px-3 py-2">Cancelled</span>
                            @else
                                <span class="badge badge-warning px-3 py-2">Pending</span>
                            @endif
                        </div>

                        {{-- SELECT (UNCHANGED LOGIC) --}}
                        <select class="form-control form-control-sm appointment-status" style="width: 120px;"
                            data-id="{{ $appointment->id }}" data-current="{{ $appointment->status }}">
                            <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>
                                Confirmed
                            </option>
                            <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-12">
        <div class="doctor-appointment-paginator">
            {{ $doctorAppointments->onEachSide(1)->links() }}
        </div>
    </div>
@endif
