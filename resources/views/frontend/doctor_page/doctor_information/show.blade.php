@extends('frontend.layouts.app')

@section('content')
    @include('frontend.custom_layout.header')
    @include('frontend.doctor_page.doctor_information.partial_layout.profile_section')
    @include('frontend.doctor_page.doctor_information.partial_layout.booking_section')
    @include('frontend.custom_layout.footer')
    <script>
        window.SusthoCareUser = {
            authenticated: @json(auth()->check()),
            role: @json(auth()->check() ? auth()->user()->getRoleNames()->first() : null),
            name: @json($userAppointment->name ?? null),
            age: @json($userAppointment->age ?? null),
            phone: @json($userAppointment->phone ?? null),
            gender: @json($userAppointment->gender ?? null),
            email: @json($userAppointment->email ?? null)
        };
    </script>
    {{--  Doctor Slot Part in Doctor Show Page Start --}}
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_slot_error.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_slot_form_data.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_slot_mark_occupied.js') }}">
    </script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_time_slot_occupied.js') }}">
    </script>
    {{--  Doctor Slot Part in Doctor Show Page End --}}
    {{--  Auto User Fill Data in Doctor Show Page when Auth connected Start --}}
    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_config.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_helpers.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_fields.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_fill.js') }}"></script>
    {{--  Auto User Fill Data in Doctor Show Page when Auth connected End --}}
@endsection
