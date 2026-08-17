<div class="col-md-12">

    <div class="card shadow-sm border-0 rounded-lg">

        <div class="card-header bg-gradient-white border-0 py-3">

            <h3 class="card-title font-weight-bold text-dark mb-0">

                <i class="fas fa-user-md text-primary mr-2"></i>

                Professional Information

            </h3>

        </div>

        <div class="card-body">

            <div class="row text-center">

                {{-- QUALIFICATION --}}
                <div class="col-md-4 mb-4 mb-md-0">

                    <div class="p-4 border rounded-lg h-100 shadow-sm bg-light">

                        <div class="mb-3">

                            <span
                                class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width:60px; height:60px;">

                                <i class="fas fa-graduation-cap fa-lg"></i>

                            </span>

                        </div>

                        <h5 class="font-weight-bold text-dark">

                            Qualification

                        </h5>

                        <p class="text-muted mb-0 mt-2">

                            {{ $doctor->qualification }}

                        </p>

                    </div>

                </div>

                {{-- LOCATION --}}
                <div class="col-md-4 mb-4 mb-md-0">

                    <div class="p-4 border rounded-lg h-100 shadow-sm bg-light">

                        <div class="mb-3">

                            <span
                                class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width:60px; height:60px;">

                                <i class="fas fa-map-marker-alt fa-lg"></i>

                            </span>

                        </div>

                        <h5 class="font-weight-bold text-dark">

                            Location

                        </h5>

                        <p class="text-muted mb-0 mt-2">

                            {{ $doctor->location }}

                        </p>

                    </div>

                </div>

                {{-- CONSULTATION FEE --}}
                <div class="col-md-4">

                    <div class="p-4 border rounded-lg h-100 shadow-sm bg-light">

                        <div class="mb-3">

                            <span
                                class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width:60px; height:60px;">

                                <i class="fas fa-money-bill-wave fa-lg"></i>

                            </span>

                        </div>

                        <h5 class="font-weight-bold text-dark">

                            Consultation Fee

                        </h5>

                        <p class="text-success font-weight-bold h5 mb-0 mt-2">

                            ৳ {{ number_format($doctor->consultation_fee, 2) }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
