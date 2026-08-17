<div class="col-lg-8">
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-info shadow-lg">
                <div class="inner">
                    <h3>
                        {{ $doctor->experience_years }}
                    </h3>

                    <p>
                        Years Experience
                    </p>
                </div>

                <div class="icon">
                    <i class="fas fa-briefcase-medical"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-success shadow-lg">
                <div class="inner">
                    <h3>
                        {{ $doctor->success_rate }}%
                    </h3>

                    <p>
                        Success Rate
                    </p>
                </div>

                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-primary shadow-lg">
                <div class="inner">
                    <h3>
                        {{ $doctor->total_patients }}+
                    </h3>

                    <p>
                        Total Patients
                    </p>
                </div>

                <div class="icon">
                    <i class="fas fa-procedures"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- ABOUT --}}
    <div class="card shadow-lg border-0">
        <div class="card-header bg-white">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-user text-secondary mr-1"></i>
                About Doctor

            </h3>
        </div>

        <div class="card-body">
            <p class="text-muted" style="line-height: 2; font-size: 15px;">
                {{ $doctor->about }}
            </p>
        </div>
    </div>
</div>
