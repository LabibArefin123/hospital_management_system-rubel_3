<form method="POST" action="{{ route('appointment.store') }}" id="doctorAppointmentForm">
    @csrf
    {{-- Hidden Fields --}}
    @include('frontend.doctor_page.doctor_layout.form_layout.partials.hidden_fields')

    <div class="row">
        {{--  LEFT SIDE --}}
        <div class="col-md-6">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="booking-left">
                {{-- Title + Legend --}}
                <div class="booking-title-row">
                    <h3>Book Your Appointment</h3>
                    <div class="booking-status-legend">

                        <div class="booking-status-item">
                            <span class="booking-status-dot available"></span>
                            <span>Available</span>
                        </div>

                        <div class="booking-status-item">
                            <span class="booking-status-dot booked"></span>
                            <span>Booked</span>
                        </div>
                    </div>
                </div>

                {{-- Schedule --}}
                @include('frontend.doctor_page.doctor_layout.form_layout.partials.schedule')
                {{-- Patient Form --}}
                @include('frontend.doctor_page.doctor_layout.form_layout.partials.patient_form')
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-md-6">
            <div class="booking-right">
                {{-- Booking Summary --}}
                @include('frontend.doctor_page.doctor_layout.form_layout.partials.booking_summary')
            </div>
        </div>
    </div>
</form>
