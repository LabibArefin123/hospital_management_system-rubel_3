<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
        <div class="card dashboard-payment-card dashboard-payment-paid h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="dashboard-payment-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="ml-3">
                        <small class="text-muted font-weight-bold text-uppercase">Payment</small>
                        <h5 class="mb-1 font-weight-bold">Total Paid</h5>
                        <h3 class="text-success font-weight-bold mb-0">৳{{ number_format($totalPaid, 2) }}</h3>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <i class="fas fa-check-circle text-success mr-1"></i>
                    Successfully paid online
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
        <div class="card dashboard-payment-card dashboard-payment-cash h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="dashboard-payment-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="ml-3">
                        <small class="text-muted font-weight-bold text-uppercase">Cash</small>
                        <h5 class="mb-1 font-weight-bold">Cash Received</h5>
                        <h3 class="text-primary font-weight-bold mb-0">৳{{ number_format($cashReceived, 2) }}</h3>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <i class="fas fa-hand-holding-usd text-primary mr-1"></i>
                    Confirmed cash appointments
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card dashboard-payment-card dashboard-payment-pending h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="dashboard-payment-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="ml-3">
                        <small class="text-muted font-weight-bold text-uppercase">Cash</small>
                        <h5 class="mb-1 font-weight-bold">Cash Pending</h5>
                        <h3 class="text-warning font-weight-bold mb-0">৳{{ number_format($cashPending, 2) }}</h3>
                    </div>
                </div>
                <div class="mt-3 small text-muted">
                    <i class="fas fa-hourglass-half text-warning mr-1"></i>
                    Pending appointments awaiting confirmation
                </div>
            </div>
        </div>
    </div>
</div>
