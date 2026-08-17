  <!-- BOOKING FORM -->
  {{-- ================= GUEST VIEW (FAKE) ================= --}}
  @guest

      <!-- FORM (FAKE) -->
      <div class="col-md-6">
          <div class="booking-card">

              <h5>Your Details</h5>

              <div class="form-row">
                  <input type="text" placeholder="Full Name" disabled>
                  <input type="text" placeholder="Mobile" disabled>
              </div>

              <div class="form-row">
                  <input type="number" placeholder="Age" disabled>
                  <select disabled>
                      <option>Gender</option>
                  </select>
              </div>

              <input type="email" placeholder="Email (optional)" disabled>

              <div class="select-group">
                  <label>Payment Method</label>
                  <div class="btn-group">
                      <button disabled>Cash</button>
                      <button disabled>Online</button>
                  </div>
              </div>

              <div class="select-group">
                  <label>Select Date</label>
                  <div class="btn-group">
                      <button disabled>5 May 2026</button>
                      <button disabled>10 May 2026</button>
                  </div>
              </div>

              <div class="select-group">
                  <label>Select Time</label>
                  <div class="btn-group">
                      <button disabled>12 PM</button>
                      <button disabled>2 PM</button>
                  </div>
              </div>

              <button class="btn btn-danger w-100 mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                  🔐 Login to Book (৳{{ $service->price }})
              </button>

          </div>
      </div>

      <!-- SUMMARY (FAKE) -->
      <div class="col-md-6">
          <div class="summary-card">

              <h5>Booking Summary</h5>

              <div class="summary-row"><span>Name</span><span>Not Filled</span></div>
              <div class="summary-row"><span>Mobile</span><span>Not Filled</span></div>
              <div class="summary-row"><span>Age</span><span>Not Filled</span></div>
              <div class="summary-row"><span>Gender</span><span>Not Filled</span></div>
              <div class="summary-row"><span>Date</span><span>Not Selected</span></div>
              <div class="summary-row"><span>Time</span><span>Not Selected</span></div>
              <div class="summary-row"><span>Payment</span><span>Not Selected</span></div>

              <hr>

              <div class="summary-row total">
                  <span>Total</span><span>৳{{ $service->price }}</span>
              </div>

          </div>
      </div>

  @endguest
