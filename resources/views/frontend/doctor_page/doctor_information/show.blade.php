@extends('frontend.layouts.app')

@section('content')
    @include('frontend.custom_layout.header')
    @include('frontend.doctor_page.doctor_information.partial_layout.profile_section')
    @include('frontend.doctor_page.doctor_information.partial_layout.booking_section')
    @include('frontend.custom_layout.footer')
    {{--  Doctor Slot Part in Doctor Show Page Start --}}
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_slot_error.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_slot_form_data.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_slot_mark_occupied.js') }}">
    </script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_time_slot_occupied/doctor_time_slot_occupied.js') }}">
    </script>
    {{--  Doctor Slot Part in Doctor Show Page End --}}
@endsection
