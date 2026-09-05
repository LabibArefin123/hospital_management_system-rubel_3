@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')
<link rel="icon" type="image/png" href="{{ asset('uploads/images/logo.png') }}">
{{-- DATATABLE CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/3.0.3/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.5/css/responsive.bootstrap5.min.css">

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/backend.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/doctor_paginator.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/service_paginator.css') }}">
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        @include('backend.global_modals.validation_modal')
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

{{-- ADMINLTE JS --}}
@section('adminlte_js')
    @stack('js')
    @yield('js')
    @include('backend.layouts.custom_page_js')
@stop
