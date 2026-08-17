<div class="col-md-6">
    <div class="booking-card">

        <h5>Your Details</h5>

        <div class="form-row">
            <input type="text" id="name" placeholder="Full Name">
            <input type="text" id="mobile" placeholder="Mobile">
        </div>

        <div class="form-row">
            <input type="number" id="age" placeholder="Age">
            <select id="gender">
                <option value="">Gender</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <input type="email" id="email" placeholder="Email (optional)">

        <!-- PAYMENT -->
        <div class="select-group">
            <label>Payment Method</label>
            <div class="btn-group">
                <button type="button" class="select-btn" data-type="payment" data-value="Cash">Cash</button>
                <button type="button" class="select-btn" data-type="payment" data-value="Online">Online</button>
            </div>
        </div>

        <!-- DATE -->
        <div class="select-group">
            <label>Select Date</label>
            <div class="btn-group">
                <button type="button" class="select-btn" data-type="date" data-value="5 May 2026">5 May
                    2026</button>
                <button type="button" class="select-btn" data-type="date" data-value="10 May 2026">10 May
                    2026</button>
            </div>
        </div>

        <!-- TIME -->
        <div class="select-group">
            <label>Select Time</label>
            <div class="btn-group">
                <button type="button" class="select-btn" data-type="time" data-value="12 PM">12 PM</button>
                <button type="button" class="select-btn" data-type="time" data-value="2 PM">2 PM</button>
            </div>
        </div>

        <button class="btn-confirm" id="confirmBtn" disabled>
            Confirm Booking (৳1000)
        </button>

    </div>
</div>
