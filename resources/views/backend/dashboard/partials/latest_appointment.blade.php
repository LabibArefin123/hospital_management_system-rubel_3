<div class="card card-outline card-success">

    <div class="card-header">

        <h3 class="card-title">
            Latest Appointments
        </h3>

    </div>

    <div class="card-body p-0">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>SL</th>
                    <th>Patient</th>
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

                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $appointment->name }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </td>

                        <td>

                            @if ($appointment->status == 'confirmed')
                                <span class="badge badge-success">
                                    Confirmed
                                </span>
                            @elseif($appointment->status == 'cancelled')
                                <span class="badge badge-danger">
                                    Cancelled
                                </span>
                            @else
                                <span class="badge badge-warning">
                                    Pending
                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">
                            No appointments found
                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
