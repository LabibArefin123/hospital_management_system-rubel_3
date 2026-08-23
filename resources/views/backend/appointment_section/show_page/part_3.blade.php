<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0">
        @if ($appointment->type === 'doctor')
            <h4 class="font-weight-bold mb-0"><i class="fas fa-user-md text-primary mr-2"></i>Doctor Information</h4>
        @else
            <h4 class="font-weight-bold mb-0"><i class="fas fa-concierge-bell text-info mr-2"></i>Service Information</h4>
        @endif
    </div>
    <div class="card-body">
        @if ($appointment->type === 'doctor')
            @php $doctor=$appointment->doctor; @endphp
            @if ($doctor)
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <img src="{{ asset($doctor->image ? $doctor->image : 'uploads/images/default.jpg') }}"
                            alt="{{ $doctor->name }}" class="rounded-circle shadow-sm"
                            style="width:140px;height:140px;object-fit:cover;">
                    </div>
                    <div class="col-md-9">
                        <h3 class="font-weight-bold text-primary mb-1">{{ $doctor->name }}</h3>
                        <span class="badge badge-info px-3 py-2 mb-3">{{ $doctor->speciality ?? 'No Speciality' }}</span>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Qualification</small>
                                <strong>{{ $doctor->qualification ?? 'N/A' }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Experience</small>
                                <strong>{{ $doctor->experience_years ?? 0 }} Years</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Location</small>
                                <strong>{{ $doctor->location ?? 'N/A' }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Consultation Fee</small>
                                <strong class="text-success">৳
                                    {{ number_format($doctor->consultation_fee ?? 0, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning mb-0"><i class="fas fa-exclamation-triangle mr-2"></i>Doctor information
                    is no longer available.</div>
            @endif
        @else
            @php $service=$appointment->service; @endphp
            @if ($service)
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <img src="{{ asset($service->image ? $service->image : 'uploads/images/default.jpg') }}"
                            alt="{{ $service->title }}" class="rounded shadow-sm"
                            style="width:180px;height:140px;object-fit:cover;">
                    </div>
                    <div class="col-md-9">
                        <h3 class="font-weight-bold text-info mb-2">{{ $service->title }}</h3>
                        <div class="mb-3">
                            <span class="badge badge-success px-3 py-2">৳
                                {{ number_format($service->price ?? 0, 2) }}</span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Description</small>
                            <p class="mb-0">{{ $service->description ?? 'No description available.' }}</p>
                        </div>
                        @if (!empty($service->instructions))
                            <div>
                                <small class="text-muted d-block mb-2">Instructions</small>
                                @php $instructions=is_array($service->instructions)?$service->instructions:[$service->instructions]; @endphp
                                <ul class="mb-0 pl-3">
                                    @foreach ($instructions as $instruction)
                                        <li>{{ $instruction }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-warning mb-0"><i class="fas fa-exclamation-triangle mr-2"></i>Service
                    information is no longer available.</div>
            @endif
        @endif
    </div>
</div>
