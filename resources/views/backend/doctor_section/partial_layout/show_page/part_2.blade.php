<div class="doctor-overview-content">
    <div class="doctor-stats-grid">
        <div class="doctor-stat-card doctor-stat-card-blue">
            <div class="doctor-stat-icon"><i class="fas fa-briefcase-medical"></i></div>
            <h3 class="doctor-stat-value">{{ $doctor->experience_years }}</h3>
            <p class="doctor-stat-label">Years Experience</p>
        </div>
        <div class="doctor-stat-card doctor-stat-card-green">
            <div class="doctor-stat-icon"><i class="fas fa-chart-line"></i></div>
            <h3 class="doctor-stat-value">{{ $doctor->success_rate }}%</h3>
            <p class="doctor-stat-label">Success Rate</p>
        </div>
        <div class="doctor-stat-card doctor-stat-card-orange">
            <div class="doctor-stat-icon"><i class="fas fa-procedures"></i></div>
            <h3 class="doctor-stat-value">{{ $doctor->total_patients }}+</h3>
            <p class="doctor-stat-label">Total Patients</p>
        </div>
    </div>
    <div class="doctor-about-card">
        <div class="doctor-about-header">
            <div class="doctor-about-icon"><i class="fas fa-user"></i></div>
            <h3 class="doctor-about-title">About Doctor</h3>
        </div>
        <div class="doctor-about-body">
            @if ($doctor->about)
                <p class="doctor-about-text">{{ $doctor->about }}</p>
            @else
                <p class="doctor-about-text doctor-about-empty">No information has been added about this doctor yet.</p>
            @endif
        </div>
    </div>
</div>
