<div id="filterSection" class="card d-none">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-semibold"> Patient Name</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" id="searchPatient" class="form-control" placeholder="Search patient...">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Appointment Date</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-calendar"></i>
                    </span>
                    <input type="date" id="searchDate" class="form-control">
                </div>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Appointment Status</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <select id="searchStatus" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-danger rounded-pill" id="resetFilter" type="button">
                    <i class="fas fa-rotate-left me-1"></i>
                    Reset
                </button>
            </div>
        </div>
    </div>
</div>
