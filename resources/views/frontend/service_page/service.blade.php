@extends('frontend.layouts.app')

@section('title', 'Our Services - SusthoCare')

@section('content')
    @include('frontend.custom_layout.header')
    <!-- INTRO -->
    <section class="service-page-intro">
        <div class="container text-center">
            <h2>Our Diagnostic Services</h2>
            <p class="service-page-intro-subtitle">
                Safe, accurate & reliable testing.
            </p>
            <div class="service-page-search-wrapper">
                <input type="text" id="serviceSearch" class="service-page-search-input" placeholder="Search service..."
                    autocomplete="off">
            </div>
        </div>
    </section>

    <!-- SERVICE GRID -->
    <section class="service-page-layout-section">
        <div class="container">
            <div class="service-page-layout-grid" id="serviceGrid">
                @forelse ($services as $service)
                    <div class="service-page-layout-card" data-service-title="{{ strtolower($service->title) }}">
                        <div class="service-page-layout-content">
                            <div class="service-page-layout-image">
                                <img src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                            </div>
                            <h5> {{ $service->title }} </h5>
                        </div>

                        <a href="{{ route('service.show', $service->id) }}" class="btn-book">
                            Book Now
                        </a>
                    </div>
                @empty
                    <p class="text-center w-100"> No services found.</p>
                @endforelse
            </div>

            <p id="serviceNoResults" class="text-center w-100 mt-4" style="display: none;">
                No services found.
            </p>
        </div>
    </section>

    @include('frontend.custom_layout.footer')
     {{-- LIVE SEARCH SCRIPT --}}
    <script src="{{ asset('js/custom_frontend/service_page/service_filter.js') }}"></script>
@endsection
