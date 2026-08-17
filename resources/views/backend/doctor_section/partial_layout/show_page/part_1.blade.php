<div class="col-lg-4">

    {{-- PROFILE CARD --}}
    <div class="card card-primary card-outline shadow-lg border-0">

        <div class="card-body text-center">

            <div class="position-relative d-inline-block mb-3">

                {{-- DOCTOR IMAGE --}}
                <img class="profile-user-img img-fluid img-circle elevation-4 border border-primary"
                    src="{{ $doctor->image ? asset($doctor->image) : asset('uploads/images/default.jpg') }}"
                    id="doctorPreviewImage" style="width: 180px; height: 180px; object-fit: cover;">

                {{-- IMAGE INFO BUTTON --}}
                @if ($doctor->image)
                    <button type="button" class="btn btn-info btn-sm rounded-circle elevation-2" data-toggle="modal"
                        data-target="#doctorImageInfoModal"
                        style="
                                    position: absolute;
                                    top: 5px;
                                    left: 5px;
                                    width: 35px;
                                    height: 35px;
                                    padding: 0;
                                ">

                        <i class="fas fa-info"></i>

                    </button>
                @endif

                {{-- STATUS --}}
                <span class="badge badge-success position-absolute"
                    style="
                                    bottom: 10px;
                                    right: 10px;
                                    font-size: 12px;
                            ">

                    Active

                </span>

            </div>

            <h3 class="profile-username font-weight-bold">

                Dr. {{ $doctor->name }}

            </h3>

            <p class="text-muted mb-3">

                {{ $doctor->speciality }}

            </p>

            <span class="badge badge-primary px-4 py-2">

                {{ $doctor->availability }}

            </span>

        </div>

    </div>

</div>
