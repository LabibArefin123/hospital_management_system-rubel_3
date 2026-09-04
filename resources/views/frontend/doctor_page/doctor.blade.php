@extends('frontend.layouts.app')

@section('title', 'Our Doctors - SusthoCare')

@section('content')
    @include('frontend.custom_layout.header')
    <section class="doctor-page-intro">
        <div class="container text-center">
            <h2>Our Medical Experts</h2>
            <p class="doctor-page-intro-subtitle">
                Find your ideal doctor by name or specialization
            </p>

            <div class="doctor-page-search-wrapper">
                <input type="text" id="doctorSearch" class="doctor-page-search-input"
                    placeholder="Search doctor or specialization..." autocomplete="off">
            </div>
        </div>
    </section>

    <section class="doctor-section py-5">
        <div class="container">
            <div class="doctor-grid" id="doctorGrid">
                @forelse($doctors as $doctor)
                    <div class="doctor-card">
                        <div class="doctor-img">
                            <img src="{{ asset($doctor->image ? $doctor->image : 'uploads/images/default.jpg') }}"
                                alt="{{ $doctor->name }}">
                        </div>
                        <h5>{{ $doctor->name }}</h5>
                        <p>{{ $doctor->speciality }}</p>
                        <span> {{ $doctor->experience_years }} Years Experience</span>
                        <a href="{{ route('doctor.show', $doctor->id) }}" class="btn-book">
                            Book Now
                        </a>
                    </div>

                @empty
                    <p class="text-center w-100">
                        No doctors found.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    @include('frontend.custom_layout.footer')
    {{-- LIVE SEARCH SCRIPT --}}
    <script src="{{ asset('js/custom_frontend/doctor_page/doctor_filter.js') }}"></script>
@endsection
