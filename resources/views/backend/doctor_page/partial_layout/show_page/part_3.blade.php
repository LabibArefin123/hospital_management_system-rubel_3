<div class="doctor-professional-card">
    <div class="doctor-professional-header">
        <div class="doctor-professional-icon"><i class="fas fa-user-md"></i></div>
        <h3 class="doctor-professional-title">Professional Information</h3>
    </div>
    <div class="doctor-professional-body">
        <div class="doctor-professional-grid">
            <div class="doctor-professional-item">
                <div class="doctor-professional-item-icon blue"><i class="fas fa-graduation-cap"></i></div>
                <h5 class="doctor-professional-item-title">Qualification</h5>
                <p class="doctor-professional-item-value">{{ $doctor->qualification ?: 'Not provided' }}</p>
            </div>
            <div class="doctor-professional-item">
                <div class="doctor-professional-item-icon red"><i class="fas fa-map-marker-alt"></i></div>
                <h5 class="doctor-professional-item-title">Location</h5>
                <p class="doctor-professional-item-value">{{ $doctor->location ?: 'Not provided' }}</p>
            </div>
            <div class="doctor-professional-item">
                <div class="doctor-professional-item-icon green"><i class="fas fa-money-bill-wave"></i></div>
                <h5 class="doctor-professional-item-title">Consultation Fee</h5>
                <p class="doctor-professional-item-value doctor-professional-fee">৳
                    {{ number_format($doctor->consultation_fee, 2) }}</p>
            </div>
        </div>
    </div>
</div>
