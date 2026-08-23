<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-4 text-center border-right">
                <img src="{{ asset($schedule->service->image ? $schedule->service->image : 'uploads/images/default.jpg') }}"
                  
                    style="width:150px;height:150px;object-fit:cover;object-position:center;border:5px solid #f1f5f9;">
            </div>
            <div class="col-md-4">
                <h3 class="font-weight-bold text-primary mb-2">
                    {{ $schedule->service->title ?? 'N/A' }}
                </h3>
                <span class="badge badge-success px-4 py-2">
                    ৳ {{ $schedule->service->price ?? '0' }}
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
            <div class="col-md-4">
                <div class="mb-4">
                    <small class="text-muted d-block">
                        Service Description
                    </small>
                    <strong>
                        {{ $schedule->service->description ?? 'No Description' }}
                    </strong>
                </div>
                <div class="mb-4">
                    <small class="text-muted d-block">
                        Service ID
                    </small>
                    <strong>
                        {{ $schedule->service_id }}
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
