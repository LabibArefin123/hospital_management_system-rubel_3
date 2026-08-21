@extends('frontend.layouts.app')

@section('content')
    @include('frontend.custom_layout.header')

    <section class="service-details">
        <div class="container">
            <div class="row g-4">

                <!-- IMAGE -->
                <div class="col-md-6">
                    <div class="service-image-box">
                        <img src="{{ asset($service->image) }}">
                    </div>
                </div>

                <!-- INFO -->
                <div class="col-md-6">

                    <div class="service-info-card">
                        <h3>{{ $service->title }}</h3>

                        <div class="service-desc">
                            {{ $service->description }}
                        </div>
                    </div>

                    <div class="service-price">
                        ৳ {{ $service->price }}
                    </div>

                    <div class="pre-test-box">
                        <h5>Pre Test Instructions</h5>

                        <ul>
                            @foreach ($service->instructions as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

                @include('frontend.service_page.booking_form.form')
            </div>
        </div>
    </section>

    @include('frontend.custom_layout.footer')

    <script src="{{ asset('js/custom_frontend/service_page/show/service-state.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_page/show/service-summary.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_page/show/service-booking.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_page/show/service_time_occupied.js') }}"></script>
@endsection
