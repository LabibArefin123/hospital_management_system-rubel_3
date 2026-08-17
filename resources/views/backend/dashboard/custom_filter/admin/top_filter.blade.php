<!-- FILTER SECTION -->
<div id="adminFilterSection"
     class="card border-0 shadow-sm mb-4 d-none">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

            <div>

                <h5 class="font-weight-bold mb-1">

                    <i class="fas fa-filter text-primary mr-1"></i>

                    Dashboard Filters

                </h5>

                <small class="text-muted">  

                    Search and filter appointments quickly

                </small>

            </div>

            <button id="resetDashboardFilter"
                    class="btn btn-danger btn-sm mt-2 mt-md-0">

                <i class="fas fa-sync-alt mr-1"></i>

                Reset Filters

            </button>

        </div>

        <div class="row">

            {{-- SEARCH --}}
            <div class="col-lg-4 col-md-6 mb-3">

                <label class="font-weight-bold">

                    Search Appointment

                </label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text bg-primary border-0 text-white">

                            <i class="fas fa-search"></i>

                        </span>

                    </div>

                    <input type="text"
                           id="dashboardSearch"
                           class="form-control"
                           placeholder="Patient, doctor or service...">

                </div>

            </div>

            {{-- DATE --}}
            <div class="col-lg-2 col-md-6 mb-3">

                <label class="font-weight-bold">

                    Date

                </label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text bg-info border-0 text-white">

                            <i class="fas fa-calendar"></i>

                        </span>

                    </div>

                    <input type="date"
                           id="appointmentDateFilter"
                           class="form-control">

                </div>

            </div>

            {{-- TYPE --}}
            <div class="col-lg-2 col-md-6 mb-3">

                <label class="font-weight-bold">

                    Type

                </label>

                <select id="appointmentTypeFilter"
                        class="form-control">

                    <option value="">
                        All
                    </option>

                    <option value="doctor">
                        Doctor
                    </option>

                    <option value="service">
                        Service
                    </option>

                </select>

            </div>

            {{-- STATUS --}}
            <div class="col-lg-2 col-md-6 mb-3">

                <label class="font-weight-bold">

                    Status

                </label>

                <select id="appointmentStatusFilter"
                        class="form-control">

                    <option value="">
                        All
                    </option>

                    <option value="pending">
                        Pending
                    </option>

                    <option value="confirmed">
                        Confirmed
                    </option>

                    <option value="cancelled">
                        Cancelled
                    </option>

                </select>

            </div>

            {{-- PATIENT --}}
            <div class="col-lg-2 col-md-6 mb-3">

                <label class="font-weight-bold">

                    Patient

                </label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text bg-success border-0 text-white">

                            <i class="fas fa-user"></i>

                        </span>

                    </div>

                    <input type="text"
                           id="searchPatient"
                           class="form-control"
                           placeholder="Patient">

                </div>

            </div>

        </div>

    </div>

</div>