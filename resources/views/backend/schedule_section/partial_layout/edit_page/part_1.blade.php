<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            {{-- IMAGE --}}
            <div class="col-md-4 text-center border-right">

                <img id="doctorPreviewImage"
                    src="{{ asset($schedule->doctor->image ? $schedule->doctor->image : 'uploads/images/default.jpg') }}"
                    class="rounded-circle shadow"
                    style="
                            width: 140px;
                            height: 140px;
                            object-fit: cover;
                            border: 5px solid #f1f5f9;
                         ">

            </div>

            {{-- NAME + SPECIALITY --}}
            <div class="col-md-4">

                <h4 id="doctorPreviewName" class="font-weight-bold text-primary mb-2">

                    {{ $schedule->doctor->name }}

                </h4>

                <span id="doctorPreviewSpeciality" class="badge badge-info px-3 py-2">

                    {{ $schedule->doctor->speciality }}

                </span>

            </div>

            {{-- EMAIL + USERNAME --}}
            <div class="col-md-4">

                <div class="mb-3">

                    <small class="text-muted d-block">

                        Email

                    </small>

                    <strong id="doctorPreviewEmail">

                        {{ $schedule->doctor->user->email ?? 'No Email' }}

                    </strong>

                </div>

                <div>

                    <small class="text-muted d-block">

                        Username

                    </small>

                    <strong id="doctorPreviewUsername">

                        {{ $schedule->doctor->user->username ?? 'No Username' }}

                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>
