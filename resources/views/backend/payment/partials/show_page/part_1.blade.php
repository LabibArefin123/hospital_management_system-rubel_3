<div class="payment-section payment-patient-section">

    <div class="payment-section-header">
        <div class="payment-section-title">
            <div class="payment-section-icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h4>Patient Information</h4>
                <p>Patient and appointment details</p>
            </div>
        </div>
    </div>

    <div class="payment-info-grid">

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-user mr-1"></i>
                Patient Name
            </span>
            <strong>{{ $payment->appointment->name ?? 'N/A' }}</strong>
        </div>

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-phone mr-1"></i>
                Patient Phone
            </span>
            <strong>{{ $payment->appointment->phone ?? 'N/A' }}</strong>
        </div>

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-envelope mr-1"></i>
                Patient Email
            </span>
            <strong>{{ $payment->appointment->email ?? 'N/A' }}</strong>
        </div>

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-calendar-check mr-1"></i>
                Appointment
            </span>
            <strong>#{{ $payment->appointment->id ?? 'N/A' }}</strong>
        </div>

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-stethoscope mr-1"></i>
                Appointment Type
            </span>
            <strong>{{ $payment->appointment->type_label ?? 'N/A' }}</strong>
        </div>

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-user-md mr-1"></i>
                Doctor / Service
            </span>
            <strong>{{ $payment->appointment->provider_name ?? 'N/A' }}</strong>
        </div>

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-calendar-alt mr-1"></i>
                Appointment Date
            </span>
            <strong>{{ $payment->appointment->formatted_date ?? 'N/A' }}</strong>
        </div>

        <div class="payment-info-item">
            <span class="payment-info-label">
                <i class="fas fa-clock mr-1"></i>
                Appointment Time
            </span>
            <strong>{{ $payment->appointment->formatted_time ?? 'N/A' }}</strong>
        </div>

    </div>

    <div class="appointment-status-row">
        <span class="payment-info-label">
            <i class="fas fa-circle-check mr-1"></i>
            Appointment Status
        </span>
        <span class="status-badge status-{{ $payment->appointment->status_badge ?? 'secondary' }}">
            {{ $payment->appointment->status_label ?? 'N/A' }}
        </span>
    </div>

</div>
