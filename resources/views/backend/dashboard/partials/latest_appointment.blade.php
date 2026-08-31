<div class="card card-outline card-success">
    <div class="card-header">
        <h3 class="card-title">Latest Appointments</h3>
    </div>

    <div class="card-body">
        <table class="table table-hover" id="dataTables">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Patient</th>
                    <th>Appointment Name</th>
                    <th>Appointment Type</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($latestAppointments as $appointment)
                    <tr class="appointment-row" data-patient="{{ strtolower($appointment->name) }}"
                        data-status="{{ strtolower($appointment->status) }}"
                        data-date="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d') }}">
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $appointment->name }}</td>

                        <td>
                            <div class="d-flex align-items-center">
                                @if ($appointment->type === 'doctor' && $appointment->doctor)
                                    <img src="{{ $appointment->doctor->image ? asset($appointment->doctor->image) : asset('images/default-doctor.png') }}"
                                        alt="{{ $appointment->doctor->name }}"
                                        style="width:40px;height:40px;object-fit:cover;border-radius:50%;margin-right:10px;">

                                    <span>
                                        {{ $appointment->doctor->name }}
                                    </span>
                                @elseif($appointment->type === 'service' && $appointment->service)
                                    <img src="{{ $appointment->service->image ? asset($appointment->service->image) : asset('images/default-service.png') }}"
                                        alt="{{ $appointment->service->title }}"
                                        style="width:40px;height:40px;object-fit:cover;border-radius:50%;margin-right:10px;">

                                    <span>
                                        {{ $appointment->service->title }}
                                    </span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </div>
                        </td>

                        <td>{{ $appointment->type }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </td>

                        <td>
                            @if ($appointment->status === 'confirmed')
                                <span class="badge badge-success">Confirmed</span>
                            @elseif($appointment->status === 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            No appointments found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
