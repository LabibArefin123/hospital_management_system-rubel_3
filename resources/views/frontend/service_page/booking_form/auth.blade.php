  {{-- ================= AUTH VIEW (REAL) ================= --}}
  @auth
  <form method="POST" action="{{ route('appointments.store') }}">
      @csrf

      <input type="hidden" name="type" value="service">
      <input type="hidden" name="service_id" value="{{ $service->id }}">
      <input type="hidden" name="appointment_date" id="formDate">
      <input type="hidden" name="appointment_time" id="formTime">
      <input type="hidden" name="payment_method" id="paymentMethod">

      <div class="row g-4">

          <!-- LEFT: FORM -->
          <div class="col-md-6">
              <div class="booking-card">

                  <h5>Your Details</h5>

                  <div class="form-row">
                      <div class="w-100">
                          <label>Full Name</label>
                          <input type="text" name="name" id="name" value="{{ old('name') }}"
                              placeholder="Full Name">
                          @error('name')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>

                      <div class="w-100">
                          <label>Mobile</label>
                          <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                              placeholder="Mobile">
                          @error('phone')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="w-100">
                          <label>Age</label>
                          <input type="number" name="age" id="age" value="{{ old('age') }}"
                              placeholder="Age">
                          @error('age')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>

                      <div class="w-100">
                          <label>Gender</label>
                          <select name="gender" id="gender">
                              <option value="">Gender</option>
                              <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                              </option>
                              <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                              </option>
                          </select>
                          @error('gender')
                          <small class="text-danger">{{ $message }}</small>
                          @enderror
                      </div>
                  </div>

                  <div class="w-100">
                      <label>Email (optional)</label>
                      <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                      @error('email')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                  </div>
                  <!-- PAYMENT -->
                  <div class="select-group">
                      <label>Payment Method</label>
                      <div class="btn-group">
                          <button type="button" class="select-btn" data-type="payment"
                              data-value="Cash">Cash</button>
                          <button type="button" class="select-btn" data-type="payment"
                              data-value="Online">Online</button>
                      </div>
                      @error('payment_method')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror

                  </div>

                  <!-- DATE -->
                  <div class="select-group">
                      <label>Select Date</label>
                      <div class="btn-group">
                          <button type="button" class="select-btn" data-type="date"
                              data-value="2026-05-05">5
                              May 2026</button>
                          <button type="button" class="select-btn" data-type="date"
                              data-value="2026-05-10">10 May 2026</button>
                      </div>
                  </div>

                  <!-- TIME -->
                  <div class="select-group">
                      <label>Select Time</label>
                      <div class="btn-group">
                          <button type="button" class="select-btn" data-type="time"
                              data-value="12:00:00">12 PM</button>
                          <button type="button" class="select-btn" data-type="time"
                              data-value="14:00:00">2 PM</button>
                      </div>
                  </div>

                  <button type="submit" class="btn-confirm" id="confirmBtn" disabled>
                      Confirm Booking (৳{{ $service->price }})
                  </button>

              </div>
          </div>

          <!-- RIGHT: SUMMARY -->
          <div class="col-md-6">
              <div class="summary-card">

                  <h5>Booking Summary</h5>

                  <div class="summary-row"><span>Name</span><span id="s_name">Not Filled</span></div>
                  <div class="summary-row"><span>Mobile</span><span id="s_mobile">Not Filled</span></div>
                  <div class="summary-row"><span>Age</span><span id="s_age">Not Filled</span></div>
                  <div class="summary-row"><span>Gender</span><span id="s_gender">Not Filled</span></div>
                  <div class="summary-row"><span>Date</span><span id="s_date">Not Selected</span></div>
                  <div class="summary-row"><span>Time</span><span id="s_time">Not Selected</span></div>
                  <div class="summary-row"><span>Payment</span><span id="s_payment">Not Selected</span>
                  </div>

                  <hr>

                  <div class="summary-row total">
                      <span>Total</span>
                      <span>৳{{ $service->price }}</span>
                  </div>

              </div>
          </div>

      </div>
  </form>
  @endauth