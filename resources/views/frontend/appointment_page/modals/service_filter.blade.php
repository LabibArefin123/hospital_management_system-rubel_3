<div class="service-filter-modal" id="serviceAppointmentFilterModal" aria-hidden="true">
    <div class="service-filter-modal-overlay"></div>
    <div class="service-filter-box">
        <div class="service-filter-header">
            <div>
                <h4><i class="fas fa-filter mr-2"></i>Filter Service Bookings</h4>
                <p>Find bookings by service, status or date</p>
            </div>
            <button type="button" id="serviceAppointmentFilterClose" class="service-filter-close"
                aria-label="Close Filter">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="serviceAppointmentFilterForm">
            @if (auth()->user() && auth()->user()->hasRole('admin'))
                <div class="filter-group">
                    <label for="filterService">Service</label>
                    <select name="service_id" id="filterService" class="form-control">
                        <option value="">All Services</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="filter-group">
                <label for="serviceFilterStatus">Status</label>
                <select name="status" id="serviceFilterStatus" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="serviceFilterAppointmentDate">Appointment Date</label>
                <input type="date" name="appointment_date" id="serviceFilterAppointmentDate" class="form-control">
            </div>
            <div class="service-filter-actions">
                <button type="button" id="serviceAppointmentFilterReset" class="filter-reset-btn">
                    <i class="fas fa-undo mr-1"></i>Reset
                </button>
                <button type="submit" class="filter-apply-btn">
                    <i class="fas fa-check mr-1"></i>Apply Filter
                </button>
            </div>
        </form>
    </div>
</div>
