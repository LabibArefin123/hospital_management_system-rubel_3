<div class="doctor-filter-modal" id="doctorAppointmentFilterModal" aria-hidden="true">
    <div class="doctor-filter-modal-overlay"></div>
    <div class="doctor-filter-box">
        <div class="doctor-filter-header">
            <div>
                <h4><i class="fas fa-filter mr-2"></i>Filter Doctor Appointments</h4>
                <p>Find appointments by doctor, status or date</p>
            </div>
            <button type="button" id="doctorAppointmentFilterClose" class="doctor-filter-close" aria-label="Close Filter">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="doctorAppointmentFilterForm">
            @if (auth()->user() && auth()->user()->hasRole('admin'))
                <div class="filter-group">
                    <label for="filterDoctor">Doctor</label>
                    <select name="doctor_id" id="filterDoctor" class="form-control">
                        <option value="">All Doctors</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="filter-group">
                <label for="filterStatus">Status</label>
                <select name="status" id="filterStatus" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="filterAppointmentDate">Appointment Date</label>
                <input type="date" name="appointment_date" id="filterAppointmentDate" class="form-control">
            </div>
            <div class="doctor-filter-actions">
                <button type="button" id="doctorAppointmentFilterReset" class="filter-reset-btn">
                    <i class="fas fa-undo mr-1"></i>Reset
                </button>
                <button type="submit" class="filter-apply-btn">
                    <i class="fas fa-check mr-1"></i>Apply Filter
                </button>
            </div>
        </form>
    </div>
</div>
    