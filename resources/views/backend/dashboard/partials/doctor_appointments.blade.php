@if ($doctorAppointments->count())

    <div class="col-12 mb-4">

        <div class="d-flex align-items-center justify-content-between">

            <h4 class="font-weight-bold text-primary mb-0">
                Doctor Consultations
            </h4>

            <span class="badge badge-primary px-3 py-2" id="doctorAppointmentCount">

                {{ $doctorAppointments->count() }} Appointments

            </span>

        </div>

        <hr>

    </div>

    @foreach ($doctorAppointments as $appointment)
        <div class="col-lg-3 col-md-6 mb-4 appointment-card" data-type="doctor"
            data-status="{{ strtolower($appointment->status) }}"
            data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}"
            data-search="
        {{ strtolower($appointment->name) }}
        {{ strtolower($appointment->doctor->name ?? '') }}
        {{ strtolower($appointment->doctor->speciality ?? '') }}
    ">

            <div class="card shadow-sm border-0 h-100 rounded-lg">

                <div class="card-body">

                    {{-- PATIENT --}}
                    <div class="mb-3">
                        <h5 class="font-weight-bold mb-1">
                            {{ $appointment->name }}
                        </h5>

                        <p class="mb-0 text-muted">
                            {{ $appointment->age }} Years, {{ ucfirst($appointment->gender) }}
                        </p>
                    </div>

                    {{-- DOCTOR SECTION (FIXED ALIGNMENT) --}}
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

                {{-- STATUS (FIXED VISUAL ONLY, LOGIC UNCHANGED) --}}
                <div class="card-footer bg-white border-0 pt-2">

                    <div class="d-flex justify-content-between align-items-center">

                        {{-- BADGE (UNCHANGED LOGIC) --}}
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

@endif
