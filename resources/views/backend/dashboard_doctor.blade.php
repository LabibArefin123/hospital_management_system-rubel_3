@extends('adminlte::page')

@section('title', 'Doctor Dashboard')

@section('content_header')
    @include('backend.dashboard.custom_header.doctor')
@stop

@section('content')
    <div class="container-fluid">
        {{-- Card Box section --}}
        @include('backend.dashboard.custom_filter.doctor.top_filter')
        @include('backend.dashboard.partials.card-box')
        {{-- Latest Appointment section --}}
        @include('backend.dashboard.partials.latest_appointment')
        <div class="row">
            {{-- Doctor appointment part --}}
            @include('backend.dashboard.partials.doctor_appointments')
            {{-- Service appointment part --}}

        </div>
        @include('backend.dashboard.partials.status_modal')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let selectedAppointmentId = null;

            document.querySelectorAll('.appointment-status')
                .forEach(function(select) {

                    select.addEventListener('change', function() {

                        const appointmentId = this.dataset.id;

                        const selectedStatus = this.value;

                        const currentStatus = this.dataset.current;

                        /*
                        |--------------------------------------------------------------------------
                        | MODAL TEXT
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('statusChangeText')
                            .innerText =
                            `Do you want to change status to "${selectedStatus}" ?`;

                        /*
                        |--------------------------------------------------------------------------
                        | FORM ACTION
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('statusChangeForm')
                            .action =
                            `/appointments/change-status/${appointmentId}`;

                        /*
                        |--------------------------------------------------------------------------
                        | STATUS VALUE
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('selectedStatus')
                            .value = selectedStatus;

                        /*
                        |--------------------------------------------------------------------------
                        | SHOW MODAL
                        |--------------------------------------------------------------------------
                        */

                        $('#statusChangeModal').modal('show');

                        /*
                        |--------------------------------------------------------------------------
                        | RESET ON CANCEL
                        |--------------------------------------------------------------------------
                        */

                        $('#statusChangeModal').on('hidden.bs.modal', function() {

                            select.value = currentStatus;
                        });
                    });
                });

        });
    </script>
    <script src="{{ asset('js/custom_backend/dashboard_page/doctor/doctor-filter.js') }}"></script>
@endsection
