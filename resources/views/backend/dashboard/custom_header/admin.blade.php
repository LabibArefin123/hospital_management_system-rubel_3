<div class="card dashboard-header">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <img src="{{ asset($doctor->image ?? 'uploads/images/default.jpg') }}" alt="Doctor Image"
                        class="shadow dashboard-header-avatar">
                </div>
                <div>
                    <h2 class="dashboard-header-title">
                        Welcome,
                        <span class="dashboard-header-name">{{ $user->name }}</span>
                    </h2>
                </div>
            </div>
            <div class="mt-3 mt-md-0 d-flex align-items-center dashboard-header-actions">
                <button class="btn dashboard-header-filter shadow-sm" id="toggleFilterBtn" type="button">
                    <i class="fas fa-filter me-2"></i>
                    Filter
                    <i class="fas fa-chevron-down ms-2 filter-arrow" id="filterArrow"></i>
                </button>
                <div class="dashboard-header-badge shadow-sm">
                    <i class="fas fa-chart-line me-2"></i>
                    Admin Dashboard
                </div>
            </div>
        </div>
    </div>
</div>
