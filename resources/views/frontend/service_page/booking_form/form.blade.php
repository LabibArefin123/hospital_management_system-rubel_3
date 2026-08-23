{{-- VALIDATION ERRORS--}}
@if ($errors->any())
    <div class="service-booking-alert alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{ route('appointment.store') }}" id="serviceAppointmentForm">
    @csrf
    @include('frontend.service_page.booking_form.partials.hidden_input')
    <div class="row service-booking-row">
        {{-- LEFT SIDE --}}
        <div class="col-md-6">
            <div class="service-booking-left">
                {{-- TITLE --}}
                <div class="service-booking-title-row">
                    <div>
                        <h3>Book Your Service</h3>

                        <span class="service-booking-subtitle">
                            Select your preferred date and time
                        </span>
                    </div>

                    <div class="service-booking-status-legend">
                        <div class="service-booking-status-item">
                            <span class="service-booking-status-dot available"></span>
                            <span>Available</span>
                        </div>

                        <div class="service-booking-status-item">
                            <span class="service-booking-status-dot booked"></span>
                            <span>Booked</span>
                        </div>
                    </div>
                </div>

                {{--  SCHEDULE PART --}}
                @include('frontend.service_page.booking_form.partials.schedule_part')

                {{-- PATIENT INFORMATION --}}
                @include('frontend.service_page.booking_form.partials.patient_infomation')
            </div>

        </div>


        {{-- RIGHT SIDE --}}
        @include('frontend.service_page.booking_form.partials.booking_summary')
    </div>
</form>
