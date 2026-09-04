<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('uploads/images/logo.png') }}">

    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ config('app.name', 'SusthoCare') }}
        @endif
    </title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->

    <link rel="stylesheet" href="{{ asset('css/frontend/frontend.css') }}">
    {{-- Global system search --}}
    <link rel="stylesheet" href="{{ asset('css/frontend/system_search/system_search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/system_search/system_search_results.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/system_search/system_search_common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/system_search/system_search_doctor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/system_search/system_search_appointment.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/system_search/system_search_page_result.css') }}">
    {{-- Dedicated search page --}}
    <link rel="stylesheet" href="{{ asset('css/frontend/system_search/system_search_page.css') }}">

</head>

<body>
    <div id="app">
        <!-- Scroll Progress Bar -->
        <div id="scrollProgress"
            style="position: fixed; top: 0; left: 0; width: 0%; height: 4px; background-color: #ff6b6b; z-index: 9999; transition: width 0.25s ease;">
        </div>

        <main class="">
            @yield('content')
        </main>
    </div>
    <!-- Bootstrap JS + dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Animation duration
            easing: 'ease-in-out', // Easing style
            once: true, // Only animate once
        });
    </script>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Back to Top">
        <i class="bi bi-arrow-up"></i>
    </button>
    {{-- Start of SweetAlert2 notifications --}}

    <script>
        window.appData = {
            success: @json(session('success')),
            errors: @json($errors->all())
        };
    </script>

    {{-- End of SweetAlert2 notifications --}}
    <script>
        window.systemSearchUrl = @json(route('search.data'));
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{--  Doctor Booking Form Start --}}
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_booking/doctor-booking-core.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_booking/doctor-booking-pagination.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_booking/doctor-booking-selection-restore.js') }}">
    </script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_booking/doctor-booking-date-selection.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_booking/doctor-booking-payment-selection.js') }}">
    </script>
    <script src="{{ asset('js/custom_frontend/doctor_show/doctor_booking/doctor-booking-validation.js') }}"></script>
    {{--  Doctor Booking Form End --}}

    {{-- Service Booking Form Start --}}
    <script src="{{ asset('js/custom_frontend/service_show/service_booking/service-state.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_show/service_booking/service-booking-helpers.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_show/service_booking/service-booking-summary.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_show/service_booking/service-booking-schedule.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_show/service_booking/service-booking-payment.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_show/service_booking/service-booking-form.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/service_show/service_booking/service-booking-init.js') }}"></script>
    {{-- Service Booking Form End --}}

    <script src="{{ asset('js/custom_frontend/payment_page/payment_toggle.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/payment_page/payment_page.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/password_toggle.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/sweet_alert.js') }}"></script>

    @if (request()->routeIs('doctor.show') || request()->routeIs('service.show'))
        <script src="{{ asset('js/custom_frontend/phone_validation.js') }}"></script>
    @endif

    @if (request()->routeIs('appointment'))
        {{-- Doctor Filter Start --}}
        <script src="{{ asset('js/custom_frontend/appointment_page/doctor_part/filter_doctor_appointment_core.js') }}">
        </script>
        <script src="{{ asset('js/custom_frontend/appointment_page/doctor_part/filter_doctor_appointment_modal.js') }}">
        </script>
        <script src="{{ asset('js/custom_frontend/appointment_page/doctor_part/filter_doctor_appointment_api.js') }}"></script>
        <script src="{{ asset('js/custom_frontend/appointment_page/doctor_part/filter_doctor_appointment_ui.js') }}"></script>
        <script src="{{ asset('js/custom_frontend/appointment_page/doctor_part/filter_doctor_appointment_init.js') }}">
        </script>
        {{-- Doctor Filter End --}}

        {{-- Service Filter Start --}}
        <script src="{{ asset('js/custom_frontend/appointment_page/service_part/filter_service_appointment_core.js') }}">
        </script>
        <script src="{{ asset('js/custom_frontend/appointment_page/service_part/filter_service_appointment_modal.js') }}">
        </script>
        <script src="{{ asset('js/custom_frontend/appointment_page/service_part/filter_service_appointment_api.js') }}">
        </script>
        <script src="{{ asset('js/custom_frontend/appointment_page/service_part/filter_service_appointment_init.js') }}">
        </script>
        {{-- Doctor Filter End --}}
    @endif
</body>

</html>
