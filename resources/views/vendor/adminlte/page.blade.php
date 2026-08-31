@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')
<link rel="icon" type="image/png" href="{{ asset('uploads/images/logo2.png') }}">
{{-- DATATABLE CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/3.0.2/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.5/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('css/backend/backend.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard_page/doctor_paginator.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom_backend/dashboard_page/service_paginator.css') }}">

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        {{-- START MODAL --}}
        <div class="modal fade" id="backConfirmModal" tabindex="-1" role="dialog" aria-labelledby="backConfirmLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center p-4">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="animate-bounce" width="50" height="50"
                            fill="#FFC107" viewBox="0 0 16 16">

                            <path
                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-12a.905.905 0 0 1 .9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 3.995A.905.905 0 0 1 8 3zm.002 6a1 1 0 1 1-2.002 0 1 1 0 0 1 2.002 0z" />

                        </svg>
                    </div>

                    <div class="modal-body mb-3">
                        Please fill up the required fields before leaving the page.
                        Do you want to leave?
                    </div>

                    <div class="modal-footer d-flex justify-content-center gap-2">

                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                            Stay
                        </button>

                        <a href="#" class="btn btn-danger leave-page">
                            Leave
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- END MODAL --}}

        {{-- PRELOADER --}}
        @if ($preloaderHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- TOP NAVBAR --}}
        @if ($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- SIDEBAR --}}
        @unless ($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endunless

        {{-- CONTENT --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- FOOTER --}}
        @hasSection('footer')
            @yield('footer')
        @endif

        {{-- RIGHT SIDEBAR --}}
        @if ($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop
@section('plugins.Datatables', true)

{{--  DATATABLES PLUGIN --}}

{{-- ADMINLTE JS --}}
@section('adminlte_js')
    @stack('js')
    @yield('js')
    @include('backend.layouts.custom_page_js')
@stop
