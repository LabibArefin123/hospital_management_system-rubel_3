<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-calendar-check fa-2x text-primary mb-2"></i>
                <h3>{{ $totalAppointments }}</h3>
                <p class="mb-0">Total Appointments</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-check-circle fa-2x mb-2 text-success"></i>
                <h3>{{ $confirmedAppointments }}</h3>
                <p class="mb-0">Confirmed Appointments</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-clock fa-2x mb-2 text-warning"></i>
                <h3>{{ $pendingAppointments }}</h3>
                <p class="mb-0">Pending Appointments</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-times-circle fa-2x mb-2 text-danger"></i>
                <h3>{{ $cancelledAppointments }}</h3>
                <p class="mb-0">Cancelled Appointments</p>
            </div>
        </div>
    </div>
</div>
