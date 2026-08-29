<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h3>{{ $totalAppointments }}</h3>
                <p class="mb-0">Total Appointments</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center text-success">
                <h3>{{ $confirmedAppointments }}</h3>
                <p class="mb-0">Confirmed</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center text-warning">
                <h3>{{ $pendingAppointments }}</h3>
                <p class="mb-0">Pending</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center text-danger">
                <h3>{{ $cancelledAppointments }}</h3>
                <p class="mb-0">Cancelled</p>
            </div>
        </div>
    </div>

</div>
