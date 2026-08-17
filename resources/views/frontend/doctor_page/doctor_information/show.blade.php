@extends('frontend.layouts.app')

@section('content')
   

    @include('frontend.custom_layout.header')
    @include('frontend.doctor_page.doctor_information.partial_layout.profile_section')
    @include('frontend.doctor_page.doctor_information.partial_layout.booking_section')
    @include('frontend.custom_layout.footer')

    <script src="{{ asset('js/custom_frontend/doctor_show/booking-core.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/booking-validation.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/booking-selection.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/booking-pagination.js') }}"></script>
@endsection
