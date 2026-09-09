@extends('frontend.layouts.app')
@section('title', 'Contact Us - SusthoCare')

@section('content')
    @include('frontend.custom_layout.header')
    <!-- INTRO -->
    <section class="contact-page-intro">
        <div class="container text-center">
            <h2>Contact Our Clinic</h2>
            <p class="contact-page-intro-subtitle">
                Have a question or need assistance? Our healthcare team is here to help you with appointments, services, and
                general enquiries.
            </p>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-wrapper">
                <!-- LEFT FORM -->
               @include('frontend.contact_page.partials.part_1')
               @include('frontend.contact_page.partials.part_2')
            </div>
        </div>
    </section>

    @include('frontend.custom_layout.footer')
    <script src="{{ asset('uploads/js/custom_frontend/contact_page/contact.js') }}"></script>
@endsection
