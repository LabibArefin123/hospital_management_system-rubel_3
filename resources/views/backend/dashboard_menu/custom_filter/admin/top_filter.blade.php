<!-- DASHBOARD FILTER SECTION -->
<div id="adminFilterSection" class="admin-filter-card d-none">
    <div class="admin-filter-header">
        <div class="admin-filter-heading">
            <div class="admin-filter-icon">
                <i class="fas fa-sliders-h"></i>
            </div>
            <div>
                <h5>Dashboard Filters</h5>
                <p>Refine appointments and find records faster</p>
            </div>
        </div>
        <button type="button" id="resetDashboardFilter" class="admin-filter-reset">
            <i class="fas fa-undo-alt"></i>
            <span>Reset Filters</span>
        </button>
    </div>
    <div class="admin-filter-body">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
                <div class="admin-filter-field">
                    <label for="dashboardSearch">Search Appointment</label>
                    <div class="admin-filter-input">
                        <span class="admin-filter-input-icon">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="dashboardSearch" class="form-control"
                            placeholder="Patient, doctor or service...">
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 mb-3">
                <div class="admin-filter-field">
                    <label for="appointmentDateFilter">Appointment Date</label>
                    <div class="admin-filter-input">
                        <span class="admin-filter-input-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                        <input type="date" id="appointmentDateFilter" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 mb-3">
                <div class="admin-filter-field">
                    <label for="appointmentTypeFilter">Appointment Type</label>
                    <div class="admin-filter-input">
                        <span class="admin-filter-input-icon">
                            <i class="fas fa-layer-group"></i>
                        </span>
                        <select id="appointmentTypeFilter" class="form-control">
                            <option value="">All Types</option>
                            <option value="doctor">Doctor</option>
                            <option value="service">Service</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 mb-3">
                <div class="admin-filter-field">
                    <label for="appointmentStatusFilter">Status</label>
                    <div class="admin-filter-input">
                        <span class="admin-filter-input-icon">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        <select id="appointmentStatusFilter" class="form-control">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
