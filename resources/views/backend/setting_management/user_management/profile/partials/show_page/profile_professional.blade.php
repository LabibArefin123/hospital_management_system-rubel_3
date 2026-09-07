@if ($doctor)
    <div class="card profile-section-card border-0 shadow-sm mt-4">
        <div class="card-header profile-section-header">
            <div class="profile-section-title">
                <div class="profile-section-icon doctor-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div>
                    <h5 class="mb-0">Professional Information</h5>
                    <small class="text-muted">Your doctor profile and professional details</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div>
                            <small>Speciality</small>
                            <strong>{{ $doctor->speciality ?? 'Not Provided' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <small>Qualification</small>
                            <strong>{{ $doctor->qualification ?? 'Not Provided' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <small>Experience</small>
                            <strong>{{ $doctor->experience_years ?? 0 }} Years</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <small>Location</small>
                            <strong>{{ $doctor->location ?? 'Not Provided' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <small>Consultation Fee</small>
                            <strong>৳{{ number_format($doctor->consultation_fee ?? 0, 2) }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <small>Success Rate</small>
                            <strong>{{ $doctor->success_rate ?? 0 }}%</strong>
                        </div>
                    </div>
                </div>
            </div>
            @if ($doctor->about)
                <div class="profile-about-box">
                    <div class="profile-about-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        About Doctor
                    </div>
                    <p class="mb-0">{{ $doctor->about }}</p>
                </div>
            @endif
        </div>
    </div>
@endif
