<div class="doctor-profile-card">
    <div class="doctor-profile-cover"></div>
    <div class="doctor-profile-body">
        <div class="doctor-profile-image-wrap">
            <img src="{{ $doctor->image ? asset($doctor->image) : asset('uploads/images/default.jpg') }}"
                alt="{{ $doctor->name }}" id="doctorPreviewImage" class="doctor-profile-image">
            <span class="doctor-profile-status"><span class="doctor-profile-status-dot"></span>Active</span>
        </div>
        <h2 class="doctor-profile-name">{{ $doctor->name }}</h2>
        <p class="doctor-profile-speciality">{{ $doctor->speciality }}</p>
        <span class="doctor-profile-availability"><i class="fas fa-clock"></i>{{ $doctor->availability }}</span>
        <div class="doctor-profile-divider"></div>
        <div class="doctor-profile-meta">
            <div class="doctor-profile-meta-item">
                <span class="doctor-profile-meta-value">{{ $doctor->experience_years }}</span>
                <span class="doctor-profile-meta-label">Years Experience</span>
            </div>
            <div class="doctor-profile-meta-item">
                <span class="doctor-profile-meta-value">{{ $doctor->success_rate }}%</span>
                <span class="doctor-profile-meta-label">Success Rate</span>
            </div>
            <div class="doctor-profile-meta-item">
                <span class="doctor-profile-meta-value">{{ $doctor->total_patients }}+</span>
                <span class="doctor-profile-meta-label">Patients</span>
            </div>
        </div>
    </div>
</div>
