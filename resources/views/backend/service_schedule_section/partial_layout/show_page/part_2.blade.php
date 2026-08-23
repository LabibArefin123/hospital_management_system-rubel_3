<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h4 class="card-title font-weight-bold">
            <i class="fas fa-info-circle text-primary mr-1"></i>
            Service Schedule Information
        </h4>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <tbody>
                <tr>
                    <th width="250">Service Name</th>
                    <td>{{ $schedule->service->title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Service Price</th>
                    <td>৳ {{ $schedule->service->price ?? '0' }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $schedule->service->description ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Service ID</th>
                    <td>{{ $schedule->service_id }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>{{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($schedule->is_booked)
                            <span class="badge badge-danger px-3 py-2">
                                Booked
                            </span>
                        @else
                            <span class="badge badge-success px-3 py-2">
                                Available
                            </span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
