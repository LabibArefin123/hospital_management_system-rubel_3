<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0">
        <h4 class="font-weight-bold mb-0"><i class="fas fa-user text-primary mr-2"></i>Patient Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <small class="text-muted d-block">Full Name</small>
                <strong>{{ $appointment->name ?? 'N/A' }}</strong>
            </div>
            <div class="col-md-3 mb-3">
                <small class="text-muted d-block">Age</small>
                <strong>{{ $appointment->age ?? 'N/A' }} Years</strong>
            </div>
            <div class="col-md-3 mb-3">
                <small class="text-muted d-block">Gender</small>
                <strong>{{ $appointment->gender ?? 'N/A' }}</strong>
            </div>
            <div class="col-md-6 mb-3">
                <small class="text-muted d-block">Mobile Number</small>
                <strong><i class="fas fa-phone-alt text-success mr-1"></i>{{ $appointment->phone ?? 'N/A' }}</strong>
            </div>
            <div class="col-md-6 mb-3">
                <small class="text-muted d-block">Email</small>
                <strong><i class="fas fa-envelope text-info mr-1"></i>{{ $appointment->email ?? 'No Email' }}</strong>
            </div>
        </div>
    </div>
</div>
