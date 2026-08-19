<h4> Available Time Slots</h4>
<p class="no-slot" id="noSlotText">No time slots selected</p>

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
        <span id="selectedDate">Not Selected</span>
    </p>

    <p>
        <strong>Time:</strong>
        <span id="selectedTime"> Not Selected</span>
    </p>

    <p>
        <strong>Fee:</strong>
        <span> {{ $doctor->consultation_fee }} BDT </span>
    </p>

    <div class="payment">
        <button type="button" class="pay-btn" data-value="Cash">Cash</button>
        <button type="button" class="pay-btn-2" data-value="Online">Online</button>
    </div>

    {{--  CONFIRM --}}
    <button type="submit" id="confirmBtn" disabled>
        📞 Confirm Booking
    </button>
</div>
