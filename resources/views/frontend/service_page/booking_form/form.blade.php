  {{-- Validation Errors --}}
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <form method="POST" action="{{ route('appointment.store') }}" id="serviceAppointmentForm">

      @csrf

      <input type="hidden" name="service_id" value="{{ $service->id }}">
      <input type="hidden" name="type" value="service">

      <input type="hidden" name="appointment_date" id="serviceFormDate" value="{{ old('appointment_date') }}">

      <input type="hidden" name="appointment_time" id="serviceFormTime" value="{{ old('appointment_time') }}">

      <input type="hidden" name="payment_method" id="servicePaymentMethod" value="{{ old('payment_method') }}">

      <div class="row service-booking-row">

          {{-- =====================================================
             LEFT SIDE
        ====================================================== --}}
          <div class="col-md-6">

              @if ($errors->any())
                  <div class="service-booking-alert alert alert-danger">
                      <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

              <div class="service-booking-left">

                  {{-- TITLE --}}
                  <div class="service-booking-title-row">

                      <h3>Book Your Service</h3>

                      <div class="service-booking-status-legend">

                          <div class="service-booking-status-item">
                              <span class="service-booking-status-dot available"></span>
                              <span>Available</span>
                          </div>

                          <div class="service-booking-status-item">
                              <span class="service-booking-status-dot booked"></span>
                              <span>Booked</span>
                          </div>

                      </div>

                  </div>


                  {{-- SCHEDULE --}}
                  <div class="service-schedule-pagination-wrapper">

                      @foreach ($schedulePages as $pageIndex => $pageSchedules)
                          <div class="service-schedule-page {{ $pageIndex == 0 ? 'active' : '' }}"
                              data-page="{{ $pageIndex }}">

                              <div class="row">

                                  @foreach ($pageSchedules as $date => $schedules)
                                      <div class="col-md-4 mb-3">

                                          <div class="service-date-card-wrapper">

                                              <div class="service-date-header">

                                                  <h5>
                                                      {{ \Carbon\Carbon::parse($date)->format('l') }}
                                                  </h5>

                                                  <span>
                                                      {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                                  </span>

                                              </div>


                                              <div class="service-time-slot-container">

                                                  @foreach ($schedules as $schedule)
                                                      @php
                                                          $slotDate = $schedule->date;
                                                          $slotTime = $schedule->time;

                                                          $isOccupied = (bool) $schedule->is_booked;

                                                          if (
                                                              old('appointment_date') === $slotDate &&
                                                              old('appointment_time') === $slotTime &&
                                                              $errors->has('appointment_time')
                                                          ) {
                                                              $isOccupied = true;
                                                          }
                                                      @endphp


                                                      <div class="service-date-card {{ $isOccupied ? 'occupied' : '' }}"
                                                          data-date="{{ $slotDate }}"
                                                          data-time="{{ $slotTime }}"
                                                          data-occupied="{{ $isOccupied ? 'true' : 'false' }}"
                                                          aria-disabled="{{ $isOccupied ? 'true' : 'false' }}">

                                                          <i
                                                              class="fas {{ $isOccupied ? 'fa-times-circle' : 'fa-clock' }}"></i>

                                                          @if ($isOccupied)
                                                              <span>Booked</span>
                                                          @else
                                                              {{ \Carbon\Carbon::parse($slotTime)->format('h:i A') }}
                                                          @endif

                                                      </div>
                                                  @endforeach

                                              </div>

                                          </div>

                                      </div>
                                  @endforeach

                              </div>

                          </div>
                      @endforeach


                      {{-- PAGINATION --}}
                      @if ($schedulePages->count() > 1)
                          <div class="service-schedule-pagination-controls">

                              <button type="button" id="prevServiceSchedule">
                                  <i class="fas fa-chevron-left"></i>
                              </button>

                              <button type="button" id="nextServiceSchedule">
                                  <i class="fas fa-chevron-right"></i>
                              </button>

                          </div>
                      @endif

                  </div>


                  {{-- PATIENT FORM --}}
                  <div class="service-patient-form">

                      <div>
                          <label>Full Name *</label>

                          <input type="text" name="name" id="serviceName" value="{{ old('name') }}">

                          @error('name')
                              <small class="text-danger">
                                  {{ $message }}
                              </small>
                          @enderror
                      </div>


                      <div>
                          <label>Age *</label>

                          <input type="number" name="age" id="serviceAge" value="{{ old('age') }}">

                          @error('age')
                              <small class="text-danger">
                                  {{ $message }}
                              </small>
                          @enderror
                      </div>


                      <div>
                          <label>Mobile Number *</label>

                          <input type="text" name="phone" id="servicePhone" value="{{ old('phone') }}">

                          @error('phone')
                              <small class="text-danger">
                                  {{ $message }}
                              </small>
                          @enderror
                      </div>


                      <div>
                          <label>Gender *</label>

                          <select name="gender" id="serviceGender">

                              <option value="">Select</option>

                              <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>
                                  Male
                              </option>

                              <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>
                                  Female
                              </option>

                          </select>

                          @error('gender')
                              <small class="text-danger">
                                  {{ $message }}
                              </small>
                          @enderror
                      </div>


                      <div class="service-form-full-width">

                          <label>
                              Email
                              <span id="serviceEmailRequiredMark">(optional)</span>
                          </label>

                          <input type="email" name="email" id="serviceEmail" value="{{ old('email') }}">

                          @error('email')
                              <small class="text-danger">
                                  {{ $message }}
                              </small>
                          @enderror
                      </div>
                  </div>
              </div>
          </div>

          {{-- =====================================================
             RIGHT SIDE
        ====================================================== --}}
          <div class="col-md-6">
              <div class="service-booking-right">
                  <h4>Available Time Slots</h4>

                  <p class="service-no-slot" id="serviceNoSlotText">
                      No time slots selected
                  </p>

                  <div class="service-summary-card">
                      <p>
                          <strong>Service:</strong>
                          <span>{{ $service->name }}</span>
                      </p>
                      <p>
                          <strong>Date:</strong>
                          <span id="serviceSelectedDate">
                              Not Selected
                          </span>
                      </p>
                      <p>
                          <strong>Time:</strong>
                          <span id="serviceSelectedTime">
                              Not Selected
                          </span>
                      </p>
                      <p>
                          <strong>Fee:</strong>
                          <span>{{ $service->price }} BDT</span>
                      </p>

                      {{-- PAYMENT --}}
                      <div class="service-payment">
                          <button type="button" class="service-pay-btn" data-value="Cash">
                              Cash
                          </button>
                          <button type="button" class="service-pay-btn-online" data-value="Online">
                              Online
                          </button>
                      </div>


                      {{-- CONFIRM --}}
                      <button type="submit" id="serviceConfirmBtn" disabled>
                          📞 Confirm Booking
                      </button>
                  </div>
              </div>
          </div>
      </div>
  </form>
