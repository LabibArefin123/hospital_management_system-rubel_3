@foreach ($doctorAppointments as $app)
    <div class="appointment-card">
        <div class="top-img">
            <img src="{{ asset($app->doctor->image) }}" alt="{{ $app->doctor->name }}">
        </div>

        <h4>{{ $app->doctor->name }}</h4>
        <p>{{ $app->doctor->speciality }}</p>

        <div class="patient-info">
            <div>
                <strong>Patient:</strong>
                {{ $app->name }}
            </div>

            <div>
                <strong>Age:</strong>
                {{ $app->age }}
            </div>

            <div>
                <strong>Email:</strong>
                {{ $app->email ?: 'N/A' }}
            </div>
        </div>

        <div class="time-box">
            <span>{{ \Carbon\Carbon::parse($app->appointment_date)->format('d M Y') }}</span>
        </div>

        <div class="time-box">
            <span>{{ \Carbon\Carbon::parse($app->appointment_time)->format('h:i A') }}</span>
        </div>

        <div class="bottom-info">
            <div class="payment">{{ $app->payment_method }}</div>
            <div class="status {{ $app->status }}">{{ ucfirst($app->status) }}</div>
        </div>
    </div>
@endforeach