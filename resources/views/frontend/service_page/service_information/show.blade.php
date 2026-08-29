@extends('frontend.layouts.app')

@section('content')
    @include('frontend.custom_layout.header')
    <section class="service-details">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="service-image-box">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->name ?? $service->title }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="service-info-card">
                        <h3>{{ $service->name ?? $service->title }}</h3>
                        <div class="service-desc">{{ $service->description }}</div>
                    </div>

                    {{-- PRICE --}}
                    <div class="service-price">
                        ৳ {{ number_format($service->price, 2) }}
                    </div>

                    {{-- PRE TEST INSTRUCTIONS --}}
                    @if (!empty($service->instructions))
                        <div class="pre-test-box">
                            <h5> Pre Test Instructions</h5>
                            <ul>
                                @foreach ($service->instructions as $item)
                                    <li> {{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                @include('frontend.service_page.booking_form.form')
            </div>
        </div>
    </section>
    @include('frontend.custom_layout.footer')
    {{--  Service Slot Part in Service Show Page Start --}}
    <script src="{{ asset('js/custom_frontend/service_show/service_time_slot_occupied/service_time_occupied_mark.js') }}">
    </script>
    <script src="{{ asset('js/custom_frontend/service_show/service_time_slot_occupied/service_time_occupied_detect.js') }}">
    </script>
    <script src="{{ asset('js/custom_frontend/service_show/service_time_slot_occupied/service_time_occupied_init.js') }}">
    </script>
    {{--  Service Slot Part in Service Show Page End --}}
    <script>
        window.SusthoCareUser = {
            authenticated: @json(auth()->check()),
            role: @json(auth()->check() ? auth()->user()->getRoleNames()->first() : null),

            name: @json($userAppointment->name ?? null),
            age: @json($userAppointment->age ?? null),
            phone: @json($userAppointment->phone ?? null),
            email: @json($userAppointment->email ?? null)
        };
    </script>

    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_config.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_helpers.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_fields.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/user_appointment/user_form_fill.js') }}"></script>
@endsection
