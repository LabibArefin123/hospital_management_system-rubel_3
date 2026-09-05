@extends('adminlte::page')

@section('title', 'Payment Records')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/index_page/payment_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/index_page/payment_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/index_page/payment_index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/index_page/payment_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/index_page/payment_provider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/payment_page/index_page/payment_actions.css') }}">
@stop

@section('content_header')
    <div class="payment-page-header">
        <div class="payment-header-content">
            <div class="payment-header-icon">
                <i class="fas fa-money-check-alt"></i>
            </div>
            <div>
                <h1>Payment Records</h1>
                <p>View and manage all payment transactions</p>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="payment-index-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="payment-filter-card">
                    <div class="payment-filter-header">
                        <div>
                            <h3>
                                <i class="fas fa-filter"></i>
                                Filter Payments
                            </h3>
                            <p>Filter payment records by status, method, type, or date</p>
                        </div>
                    </div>
                    @include('backend.payment.partials.index_page.payment_filter')
                </div>
            </div>
        </div>
        @include('backend.payment.partials.index_page.payment_content')
    </div>
@stop
