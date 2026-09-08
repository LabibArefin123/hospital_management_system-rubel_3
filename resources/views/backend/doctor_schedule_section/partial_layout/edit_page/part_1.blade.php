<div class="card doctor-preview-card mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="doctor-preview-image-wrapper">
                    <img id="doctorPreviewImage"
                        src="{{ asset($schedule->doctor->image ? $schedule->doctor->image : 'uploads/images/default.jpg') }}"
                        class="doctor-preview-image" alt="{{ $schedule->doctor->name }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="doctor-preview-info">
                    <h4 id="doctorPreviewName" class="doctor-preview-name">{{ $schedule->doctor->name }}</h4>
                    <span id="doctorPreviewSpeciality"
                        class="doctor-preview-speciality badge badge-info">{{ $schedule->doctor->speciality }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="doctor-preview-info">
                    <div class="doctor-preview-detail">
                        <span class="doctor-preview-label">Email</span>
                        <strong id="doctorPreviewEmail"
                            class="doctor-preview-value">{{ $schedule->doctor->user->email ?? 'No Email' }}</strong>
                    </div>
                    <div class="doctor-preview-detail">
                        <span class="doctor-preview-label">Username</span>
                        <strong id="doctorPreviewUsername"
                            class="doctor-preview-value">{{ $schedule->doctor->user->username ?? 'No Username' }}</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="row doctor-preview-grid">
            <div class="col-md-3 col-6 mb-3">
                <div class="doctor-preview-grid-item">
                    <span class="doctor-preview-grid-label">Qualification</span>
                    <strong id="doctorPreviewQualification"
                        class="doctor-preview-grid-value">{{ $schedule->doctor->qualification ?? 'N/A' }}</strong>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="doctor-preview-grid-item">
                    <span class="doctor-preview-grid-label">Experience</span>
                    <strong id="doctorPreviewExperience"
                        class="doctor-preview-grid-value doctor-preview-experience">{{ $schedule->doctor->experience_years ?? 0 }}
                        Years</strong>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="doctor-preview-grid-item">
                    <span class="doctor-preview-grid-label">Success Rate</span>
                    <strong id="doctorPreviewSuccessRate"
                        class="doctor-preview-grid-value doctor-preview-success">{{ $schedule->doctor->success_rate ?? 0 }}%</strong>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="doctor-preview-grid-item">
                    <span class="doctor-preview-grid-label">Total Patients</span>
                    <strong id="doctorPreviewTotalPatients"
                        class="doctor-preview-grid-value">{{ $schedule->doctor->total_patients ?? 0 }}</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="doctor-preview-detail">
                    <span class="doctor-preview-label">Location</span>
                    <strong id="doctorPreviewLocation"
                        class="doctor-preview-value">{{ $schedule->doctor->location ?? 'N/A' }}</strong>
                </div>
            </div>
            <div class="col-md-6">
                <div class="doctor-preview-detail">
                    <span class="doctor-preview-label">Consultation Fee</span>
                    <strong id="doctorPreviewConsultationFee" class="doctor-preview-value doctor-preview-fee">৳
                        {{ $schedule->doctor->consultation_fee ?? 0 }}</strong>
                </div>
            </div>
        </div>
        <div class="doctor-preview-about">
            <span class="doctor-preview-label">About Doctor</span>
            <strong id="doctorPreviewAbout"
                class="doctor-preview-value">{{ $schedule->doctor->about ?? 'No information available.' }}</strong>
        </div>
    </div>
</div>
