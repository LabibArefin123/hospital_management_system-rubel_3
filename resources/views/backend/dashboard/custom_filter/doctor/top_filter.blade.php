<!-- FILTER SECTION -->
<div id="filterSection" class="card shadow-sm border-0 mb-4 d-none">

    <div class="card-body">

        <div class="row g-3">

            <!-- PATIENT SEARCH -->
            <div class="col-md-5">

                <label class="form-label fw-semibold">
                    Patient Name
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>

                    <input type="text" id="searchPatient" class="form-control" placeholder="Search patient...">

                </div>

            </div>

            <!-- DATE FILTER -->
            <div class="col-md-4">

                <label class="form-label fw-semibold">
                    Appointment Date
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="fas fa-calendar"></i>
                    </span>

                    <input type="date" id="searchDate" class="form-control">

                </div>

            </div>

            <!-- RESET -->
            <div class="col-md-3 d-flex align-items-end">

                <button class="btn btn-danger w-100 rounded-pill" id="resetFilter">

                    <i class="fas fa-rotate-left me-1"></i>

                    Reset

                </button>

            </div>

        </div>

    </div>

</div>
