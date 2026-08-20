<div class="payment-summary">
    <h4>Contact Information</h4>
    <div class="contact-info">
        <p>
            <strong>Patient Name:</strong>
            {{ $appointment->name }}
        </p>
        <p>
            <strong>Email Address:</strong>
            {{ $appointment->email ?? 'No Email Provided' }}
        </p>
        <p>
            <strong>Phone Number:</strong>
            {{ $appointment->phone }}
        </p>
        <p>
            <strong>Appointment Date:</strong>
            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
        </p>
        <p>
            <strong>Appointment Time:</strong>
            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i:s A') }}
        </p>
    </div>

    <hr>

    <h4>Payment Summary</h4>
    @if ($appointment->type === 'doctor')
        <p>
            <strong>Doctor:</strong>
            {{ $appointment->doctor->name }}
        </p>
        <p>
            <strong>Speciality:</strong>
            {{ $appointment->doctor->speciality }}
        </p>
        <p>
            <strong>Consultation Fee:</strong>
            {{ $appointment->amount }} BDT
        </p>
    @else
        <p>
            <strong>Service:</strong>
            {{ $appointment->service->title }}
        </p>
        <p>
            <strong>Price:</strong>
            {{ $appointment->amount }} BDT
        </p>
    @endif
    <hr>

    <div class="total">
        <span>Total Payable</span>
        <span>{{ $appointment->amount }} Taka</span>
    </div>
</div>
