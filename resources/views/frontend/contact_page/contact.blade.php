@extends('frontend.layouts.app')
@section('title', 'Contact Us - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- INTRO -->
    <section class="contact-intro">
        <div class="container text-center">
            <h2>Contact Our Clinic</h2>
            <p>Fill the form — we'll connect you instantly via WhatsApp</p>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact-section">
        <div class="container">

            <div class="contact-wrapper">

                <!-- LEFT FORM -->
                <div class="contact-form-box">
                    <h4>Send Message</h4>

                    {{-- SUCCESS MESSAGE --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        {{-- Row 1 --}}
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        {{-- Row 2 --}}
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                    placeholder="01XXXXXXXXX">

                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <select name="department" class="form-control @error('department') is-invalid @enderror">

                                    <option value="">Select</option>

                                    <option value="Cardiology" {{ old('department') == 'Cardiology' ? 'selected' : '' }}>
                                        Cardiology</option>
                                    <option value="Dermatology" {{ old('department') == 'Dermatology' ? 'selected' : '' }}>
                                        Dermatology</option>
                                    <option value="Neurology" {{ old('department') == 'Neurology' ? 'selected' : '' }}>
                                        Neurology</option>
                                    <option value="Gynecology" {{ old('department') == 'Gynecology' ? 'selected' : '' }}>
                                        Gynecology</option>

                                </select>

                                @error('department')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        {{-- Service --}}
                        <div class="form-group">
                            <label>Service</label>

                            <select name="service" class="form-control @error('service') is-invalid @enderror">

                                <option value="">Select Service</option>

                                <option value="Consultation" {{ old('service') == 'Consultation' ? 'selected' : '' }}>
                                    Consultation</option>
                                <option value="Checkup" {{ old('service') == 'Checkup' ? 'selected' : '' }}>Checkup
                                </option>
                                <option value="Emergency" {{ old('service') == 'Emergency' ? 'selected' : '' }}>Emergency
                                </option>

                            </select>

                            @error('service')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div class="form-group">
                            <label>Message</label>

                            <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>

                            @error('message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            Send Message
                        </button>

                    </form>
                </div>

                <!-- RIGHT SIDE -->
                <div class="contact-right">

                    <!-- Visit -->
                    <div class="info-card">
                        <h5>Visit Our Clinic</h5>
                        <p>📍 Dhaka, Bangladesh</p>
                        <p>📞 017XXXXXXXX</p>
                        <p>✉ info@susthocare.com</p>
                    </div>

                    <!-- Map -->
                    <div class="info-card map-card">
                        <iframe
                            src="https://maps.google.com/maps?q=mirpur%20dohs%20dhaka&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Hours -->
                    <div class="info-card">
                        <h5>Clinic Hours</h5>
                        <p>Mon - Sat</p>
                        <strong>9:00 AM - 6:00 PM</strong>
                    </div>

                </div>

            </div>

        </div>
    </section>

    @include('frontend.custom_layout.footer')
    <script src="{{ asset('uploads/js/custom_frontend/contact_page/contact.js') }}"></script>
@endsection
