@extends('adminlte::page')

@section('title', 'User Dashboard')

@section('content_header')
    @include('backend.dashboard.custom_header.user')
@stop

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/user_part/header_part/dashboard_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/user_part/payment_part/payment_box.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/dashboard_page/user_part/appointment_part/appointment_box.css') }}">
@stop

@section('content')
    {{-- ================= STATS CARD PART ================= --}}
    @include('backend.dashboard.partials.user_part.card_box')
    {{-- ================= PAYMENT PART================= --}}
    @include('backend.dashboard.partials.user_part.payment_box')
    {{-- ================= LATEST APPOINTMENTS ================= --}}
    @include('backend.dashboard.partials.user_part.latest_appointment')
    {{-- ================= ALL APPOINTMENTS ================= --}}
    @include('backend.dashboard.partials.user_part.all_appointment')
@endsection
