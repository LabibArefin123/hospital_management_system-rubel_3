{{-- ================= AUTH REAL FORM ================= --}}
@auth
    <div class="col-md-6">
        <div class="booking-left">
            <h3>Book Your Appointment</h3>
            <div class="schedule-pagination-wrapper">
                @foreach ($schedulePages as $pageIndex => $pageSchedules)
                    <div class="schedule-page {{ $pageIndex == 0 ? 'active' : '' }}" data-page="{{ $pageIndex }}">
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
                                                <div class="date-card" data-date="{{ $schedule->date }}"
                                                    data-time="{{ $schedule->time }}">
                                                    <i class="fas fa-clock text-primary"></i>
                                                    {{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

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

            <form method="POST" action="{{ route('appointment.store') }}">
                @csrf
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                <input type="hidden" name="type" value="doctor">
                <input type="hidden" name="appointment_date" id="formDate" value="{{ old('appointment_date') }}">

                <input type="hidden" name="appointment_time" id="formTime" value="{{ old('appointment_time') }}">
                <input type="hidden" name="payment_method" id="paymentMethod">

                <div class="patient-form">
                    <div>
                        <label>Full Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>Age *</label>
                        <input type="number" name="age" id="age" value="{{ old('age') }}">
                        @error('age')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>Mobile Number *</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label>Gender *</label>
                        <select name="gender" id="gender">
                            <option value="">Select</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                            </option>
                        </select>
                        @error('gender')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="full-width">
                        <label>Email (optional)</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="booking-right">
            <h4>Available Time Slots</h4>
            <p class="no-slot" id="noSlotText">No time slots selected</p>
            <div class="summary-card">
                <p><strong>Doctor:</strong> <span>{{ $doctor->name }}</span></p>
                <p><strong>Speciality:</strong> <span>{{ $doctor->speciality }}</span></p>
                <p><strong>Date:</strong> <span id="selectedDate">Not Selected</span></p>
                <p><strong>Time:</strong> <span id="selectedTime">Not Selected</span></p>
                <p><strong>Fee:</strong> <span>{{ $doctor->consultation_fee }} BDT</span></p>
                <div class="payment">
                    <button type="button" class="pay-btn" data-value="Cash">Cash</button>
                    <button type="button" class="pay-btn" data-value="Online">Online</button>
                </div>
                <button type="submit" id="confirmBtn" disabled>
                    📞 Confirm Booking
                </button>
            </div>
        </div>
    </div>
    </form>
@endauth
