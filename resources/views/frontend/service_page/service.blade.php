@extends('frontend.layouts.app')

@section('title', 'Our Services - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    <!-- INTRO -->
    <section class="service-intro">
        <div class="container text-center">
            <h2>Our Diagnostic Services</h2>
            <p>Safe, accurate & reliable testing.</p>
        </div>
    </section>

    <!-- SERVICE GRID -->
    <section class="service-section">
        <div class="container">
            <div class="service-grid">

                @forelse ($services as $service)
                    <div class="service-card">

                        <div class="service-content">
                            <div class="service-icon">
                                <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                            </div>

                            <h5>{{ $service->title }}</h5>
                        </div>

                        <a href="{{ route('service.show', $service->id) }}" class="btn-book">
                            Book Now
                        </a>

                    </div>
                @empty
                    <p class="text-center w-100">No services found.</p>
                @endforelse

            </div>
        </div>
    </section>

    @include('frontend.custom_layout.footer')

@endsection
