<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            {{-- IMAGE --}}
            <div class="col-md-4 text-center border-right">

                <img src="{{ asset($schedule->doctor->image ? $schedule->doctor->image : 'uploads/images/default.jpg') }}"
                    class="rounded-circle shadow"
                    style="
                            width: 150px;
                            height: 150px;
                            object-fit: cover;
                            border: 5px solid #f1f5f9;
                         ">

            </div>

            {{-- NAME + SPECIALITY --}}
            <div class="col-md-4">

                <h3 class="font-weight-bold text-primary mb-2">

                    {{ $schedule->doctor->name ?? 'N/A' }}

                </h3>

                <span class="badge badge-info px-4 py-2">

                    {{ $schedule->doctor->speciality ?? 'No Speciality' }}

                </span>

                <div class="mt-4">

                    <small class="text-muted d-block">

                        Schedule Date

                    </small>

                    <strong>

                        {{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}

                    </strong>

                </div>

                <div class="mt-3">

                    <small class="text-muted d-block">

                        Schedule Time

                    </small>

                    <strong>

                        {{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}

                    </strong>

                </div>

            </div>

            {{-- EMAIL + USERNAME + STATUS --}}
            <div class="col-md-4">

                <div class="mb-4">

                    <small class="text-muted d-block">

                        Email

                    </small>

                    <strong>

                        {{ $schedule->doctor->user->email ?? 'No Email' }}

                    </strong>

                </div>

                <div class="mb-4">

                    <small class="text-muted d-block">

                        Username

                    </small>

                    <strong>

                        {{ $schedule->doctor->user->username ?? 'No Username' }}

                    </strong>

                </div>

                <div>

                    <small class="text-muted d-block mb-2">

                        Current Status

                    </small>

                    @if ($schedule->is_booked)
                        <span class="badge badge-danger px-4 py-2">

                            <i class="fas fa-times-circle mr-1"></i>

                            Booked

                        </span>
                    @else
                        <span class="badge badge-success px-4 py-2">

                            <i class="fas fa-check-circle mr-1"></i>

                            Available

                        </span>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
