@extends('adminlte::page')

@section('title', 'Payment Details')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/show_page/payment_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/show_page/payment_patient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/show_page/payment_information.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/show_page/payment_reference.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/show_page/payment_show.css') }}">
@stop

@section('content_header')
    <div class="payment-page-header">
        <div class="payment-header-content">
            <div class="payment-header-icon">
                <i class="fas fa-receipt"></i>
            </div>
            <div>
                <h1>Payment Details</h1>
                <p>Review payment, patient and appointment information</p>
            </div>
        </div>
        <a href="{{ route('payments.index') }}" class="payment-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Payments</span>
        </a>
    </div>
@stop

@section('content')
    {{-- This is for payment show page sections --}}
    <div class="payment-show-wrapper">
        {{-- This is for patient and appointment information --}}
        @include('backend.payment.partials.show_page.part_1')
        {{-- This is for payment information --}}
        @include('backend.payment.partials.show_page.part_2')
        {{-- This is for transaction and payment reference --}}
        @include('backend.payment.partials.show_page.part_3')
    </div>
@stop
