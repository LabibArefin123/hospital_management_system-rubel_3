<h4>
    Available Time Slots
</h4>

<p class="no-slot" id="noSlotText">
    No time slots selected
</p>


<div class="summary-card">

    {{-- Doctor --}}
    <p>
        <strong>Doctor:</strong>
        <span>{{ $doctor->name }}</span>
    </p>


    {{-- Speciality --}}
    <p>
        <strong>Speciality:</strong>
        <span>{{ $doctor->speciality }}</span>
    </p>


    {{-- Date --}}
    <p>
        <strong>Date:</strong>
        <span id="selectedDate">
            Not Selected
        </span>
    </p>


    {{-- Time --}}
    <p>
        <strong>Time:</strong>
        <span id="selectedTime">
            Not Selected
        </span>
    </p>


    {{-- Fee --}}
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
