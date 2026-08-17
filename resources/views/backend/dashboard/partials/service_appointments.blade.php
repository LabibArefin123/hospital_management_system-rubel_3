  @if ($serviceAppointments->count())

      <div class="col-12 mt-5 mb-4">

          <div class="d-flex align-items-center justify-content-between">

              <h4 class="font-weight-bold text-success mb-0">
                  Service Bookings
              </h4>

              <span class="badge badge-success px-3 py-2" id="serviceAppointmentCount">

                  {{ $serviceAppointments->count() }} Bookings

              </span>

          </div>

          <hr>

      </div>

      @foreach ($serviceAppointments as $appointment)
          <div class="col-lg-3 col-md-6 mb-4 appointment-card" data-type="service"
              data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}"
              data-status="{{ strtolower($appointment->status) }}"
              data-search="
        {{ strtolower($appointment->name) }}
        {{ strtolower($appointment->service->title ?? '') }}
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

                      {{-- SERVICE PROFILE BLOCK (FIXED LIKE DOCTOR STYLE) --}}
                      <div class="d-flex align-items-center mb-3 p-2 rounded" style="background:#f4fff7;">

                          {{-- IMAGE --}}
                          <div class="mr-3">
                              <img src="{{ asset($appointment->service->image ?? 'images/default-service.jpg') }}"
                                  style="
                            width:55px;
                            height:55px;
                            border-radius:12px;
                            object-fit:cover;
                            border:2px solid #28a745;
                         ">
                          </div>

                          {{-- SERVICE INFO --}}
                          <div class="flex-grow-1">
                              <div class="font-weight-bold">
                                  {{ $appointment->service->title ?? 'N/A' }}
                              </div>

                              <small class="text-muted">
                                  Service Booking
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

                  {{-- STATUS FOOTER (LOGIC UNCHANGED, ONLY UI FIXED) --}}
                  <div class="card-footer bg-white border-0 pt-2">

                      <div class="d-flex justify-content-between align-items-center">

                          {{-- BADGE --}}
                          <div>
                              @if ($appointment->status == 'confirmed')
                                  <span class="badge badge-success px-3 py-2">Confirmed</span>
                              @elseif($appointment->status == 'cancelled')
                                  <span class="badge badge-danger px-3 py-2">Cancelled</span>
                              @else
                                  <span class="badge badge-warning px-3 py-2">Pending</span>
                              @endif
                          </div>

                          {{-- SELECT --}}
                          <select class="form-control form-control-sm appointment-status" style="width:120px;"
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
