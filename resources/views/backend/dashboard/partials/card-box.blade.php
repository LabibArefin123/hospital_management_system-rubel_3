<div class="row">
    <div class="col-lg col-md-6 col-12">
        <div class="small-box bg-info shadow-sm">
            <div class="inner">
                <h3>{{ $totalAppointments }}</h3>
                <p>Total Appointments</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <div class="col-lg col-md-6 col-12">
        <div class="small-box bg-success shadow-sm">
            <div class="inner">
                <h3>৳{{ number_format($totalEarnings, 2) }}</h3>
                <p>Total Earnings</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

    <div class="col-lg col-md-6 col-12">
        <div class="small-box bg-primary shadow-sm">
            <div class="inner">
                <h3>{{ $completedAppointments }}</h3>
                <p>Confirmed Appointments</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg col-md-6 col-12">
        <div class="small-box bg-warning shadow-sm">
            <div class="inner">
                <h3>{{ $pendingAppointments }}</h3>
                <p>Pending Appointments</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="col-lg col-md-6 col-12">
        <div class="small-box bg-danger shadow-sm">
            <div class="inner">
                <h3>{{ $cancelledAppointments }}</h3>
                <p>Cancelled Appointments</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>
</div>
