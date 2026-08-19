<form method="POST" action="{{ route('appointment.store') }}" id="appointmentForm">
    @csrf

    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
    <input type="hidden" name="type" value="doctor">

    <input type="hidden" name="appointment_date" id="formDate" value="{{ old('appointment_date') }}">

    <input type="hidden" name="appointment_time" id="formTime" value="{{ old('appointment_time') }}">

    <input type="hidden" name="payment_method" id="paymentMethod" value="{{ old('payment_method') }}">

    <div class="row">

        {{-- =====================================================
             LEFT SIDE
        ====================================================== --}}
        <div class="col-md-6">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="booking-left">

                {{-- =================================================
                     TITLE + LEGEND
                ================================================== --}}
                <div class="booking-title-row">

                    <h3>Book Your Appointment</h3>

                    <div class="booking-status-legend">

                        <div class="booking-status-item">
                            <span class="booking-status-dot available"></span>
                            <span>Available</span>
                        </div>

                        <div class="booking-status-item">
                            <span class="booking-status-dot booked"></span>
                            <span>Booked</span>
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SCHEDULE
                ================================================== --}}
                <div class="schedule-pagination-wrapper">

                    @foreach ($schedulePages as $pageIndex => $pageSchedules)
                        <div class="schedule-page {{ $pageIndex == 0 ? 'active' : '' }}"
                            data-page="{{ $pageIndex }}">

                            <div class="row">

                                @foreach ($pageSchedules as $date => $schedules)
                                    <div class="col-md-4 mb-3">

                                        <div class="date-card-wrapper">

                                            <div class="date-header">

                                                <h5>
                                                    {{ \Carbon\Carbon::parse($date)->format('l') }}
                                                </h5>

                                                <span>
                                                    {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                                </span>

                                            </div>


                                            <div class="time-slot-container">

                                                @foreach ($schedules as $schedule)
                                                    @php

                                                        $slotDate = $schedule->date;
                                                        $slotTime = $schedule->time;

                                                        $isOccupied = (bool) $schedule->is_booked;

                                                        /*
                                                        |--------------------------------------------------------------------------
                                                        | If the booking failed because another user booked
                                                        | the slot, keep the slot visually occupied.
                                                        |--------------------------------------------------------------------------
                                                        */

                                                        if (
                                                            old('appointment_date') === $slotDate &&
                                                            old('appointment_time') === $slotTime &&
                                                            $errors->has('appointment_time')
                                                        ) {
                                                            $isOccupied = true;
                                                        }

                                                    @endphp


                                                    <div class="date-card {{ $isOccupied ? 'occupied' : '' }}"
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


                    {{-- =================================================
                         PAGINATION
                    ================================================== --}}
                    @if ($schedulePages->count() > 1)
                        <div class="schedule-pagination-controls">

                            <button type="button" id="prevSchedule">
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            <button type="button" id="nextSchedule">
                                <i class="fas fa-chevron-right"></i>
                            </button>

                        </div>
                    @endif

                </div>


                {{-- =================================================
                     PATIENT FORM
                ================================================== --}}
                <div class="patient-form">

                    {{-- Full Name --}}
                    <div>

                        <label>
                            Full Name *
                        </label>

                        <input type="text" name="name" id="name" value="{{ old('name') }}">

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Age --}}
                    <div>

                        <label>
                            Age *
                        </label>

                        <input type="number" name="age" id="age" value="{{ old('age') }}">

                        @error('age')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div>

                        <label>
                            Mobile Number *
                        </label>

                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}">

                        @error('phone')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Gender --}}
                    <div>

                        <label>
                            Gender *
                        </label>

                        <select name="gender" id="gender">

                            <option value="">
                                Select
                            </option>

                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>

                        </select>

                        @error('gender')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="full-width">

                        <label id="emailLabel">
                            Email <span id="emailRequiredMark">(optional)</span>
                        </label>

                        <input type="email" name="email" id="email" value="{{ old('email') }}">

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

            <div class="booking-right">

                <h4>
                    Available Time Slots
                </h4>

                <p class="no-slot" id="noSlotText">
                    No time slots selected
                </p>


                <div class="summary-card">

                    <p>
                        <strong>Doctor:</strong>
                        <span>{{ $doctor->name }}</span>
                    </p>

                    <p>
                        <strong>Speciality:</strong>
                        <span>{{ $doctor->speciality }}</span>
                    </p>

                    <p>
                        <strong>Date:</strong>
                        <span id="selectedDate">
                            Not Selected
                        </span>
                    </p>

                    <p>
                        <strong>Time:</strong>
                        <span id="selectedTime">
                            Not Selected
                        </span>
                    </p>

                    <p>
                        <strong>Fee:</strong>
                        <span>
                            {{ $doctor->consultation_fee }} BDT
                        </span>
                    </p>


                    {{-- =================================================
                         PAYMENT
                    ================================================== --}}
                    <div class="payment">

                        <button type="button" class="pay-btn" data-value="Cash">
                            Cash
                        </button>

                        <button type="button" class="pay-btn-2" data-value="Online">
                            Online
                        </button>

                    </div>


                    {{-- =================================================
                         CONFIRM
                    ================================================== --}}
                    <button type="submit" id="confirmBtn" disabled>
                        📞 Confirm Booking
                    </button>

                </div>

            </div>

        </div>

    </div>

</form>
