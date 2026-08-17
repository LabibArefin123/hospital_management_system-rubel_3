 {{-- ================= GUEST COPY (FAKE UI) ================= --}}
 @guest
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

                 {{-- PAGINATION --}}
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

             <div class="patient-form">
                 <div>
                     <label>Full Name *</label>
                     <input type="text" placeholder="Enter your name" disabled>
                 </div>

                 <div>
                     <label>Age *</label>
                     <input type="number" disabled>
                 </div>

                 <div>
                     <label>Mobile Number *</label>
                     <input type="text" disabled>
                 </div>

                 <div>
                     <label>Gender *</label>
                     <select disabled>
                         <option>Select</option>
                         <option>Male</option>
                         <option>Female</option>
                     </select>
                 </div>

                 <div class="full-width">
                     <label>Email (optional)</label>
                     <input type="email" disabled>
                 </div>
             </div>
         </div>
     </div>

     <div class="col-md-6">
         <div class="booking-right">
             <h4>Available Time Slots</h4>
             <p class="no-slot">No time slots selected</p>
             <div class="summary-card">
                 <p><strong>Doctor:</strong> <span>{{ $doctor->name }}</span></p>
                 <p><strong>Speciality:</strong> <span>{{ $doctor->speciality }}</span></p>
                 <p><strong>Date:</strong> <span>Not Selected</span></p>
                 <p><strong>Time:</strong> <span>Not Selected</span></p>
                 <p><strong>Fee:</strong> <span>{{ $doctor->consultation_fee }} BDT</span></p>
                 <button class="btn btn-danger w-100 mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                     🔐 Login to Book
                 </button>
             </div>
         </div>
     </div>
 @endguest
