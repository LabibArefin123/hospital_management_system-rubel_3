@extends('frontend.layouts.app')

@section('content')
    @include('frontend.custom_layout.header')
    @include('frontend.doctor_page.doctor_information.partial_layout.profile_section')
    @include('frontend.doctor_page.doctor_information.partial_layout.booking_section')
    @include('frontend.custom_layout.footer')
@endsection
