@extends('adminlte::page')

@section('title', 'Payment Details')

@section('content_header')
    <h1 class="font-weight-bold">
        Payment Details
    </h1>
@stop

@section('content')

    <div class="card border-0 shadow-sm">

        {{-- HEADER --}}
        <div class="card-header bg-gradient-success border-0">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h3 class="text-white font-weight-bold mb-1">
                        Transaction Overview
                    </h3>

                    <small class="text-light">
                        Payment Information & Billing Details
                    </small>

                </div>

                <div class="text-white">
                    <i class="fas fa-credit-card fa-2x"></i>
                </div>

            </div>

        </div>

        {{-- BODY --}}
        <div class="card-body p-4">

            <div class="row">

                {{-- USER --}}
                <div class="col-md-6 mb-4">

                    <div class="info-box bg-light border rounded">

                        <span class="info-box-icon bg-primary">
                            <i class="fas fa-user"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Patient Name
                            </span>

                            <span class="info-box-number">
                                {{ optional($payment->user)->name ?? 'Guest User' }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- AMOUNT --}}
                <div class="col-md-6 mb-4">

                    <div class="info-box bg-light border rounded">

                        <span class="info-box-icon bg-success">
                            <i class="fas fa-money-bill-wave"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Paid Amount
                            </span>

                            <span class="info-box-number">
                                ৳{{ number_format($payment->amount, 2) }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- TRANSACTION --}}
                <div class="col-md-6 mb-4">

                    <div class="info-box bg-light border rounded">

                        <span class="info-box-icon bg-info">
                            <i class="fas fa-receipt"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Transaction ID
                            </span>

                            <span class="info-box-number">
                                {{ $payment->transaction_id }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- PAYMENT METHOD --}}
                <div class="col-md-6 mb-4">

                    <div class="info-box bg-light border rounded">

                        <span class="info-box-icon bg-warning">
                            <i class="fas fa-wallet"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Payment Method
                            </span>

                            <span class="info-box-number">
                                {{ $payment->payment_method }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- STATUS --}}
                <div class="col-md-6 mb-4">

                    <div class="info-box bg-light border rounded">

                        <span class="info-box-icon bg-danger">
                            <i class="fas fa-check-circle"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Payment Status
                            </span>

                            <span class="info-box-number">

                                @if ($payment->status == 'paid')
                                    <span class="badge badge-success px-3 py-2">
                                        Paid
                                    </span>
                                @elseif($payment->status == 'failed')
                                    <span class="badge badge-danger px-3 py-2">
                                        Failed
                                    </span>
                                @else
                                    <span class="badge badge-warning px-3 py-2">
                                        Pending
                                    </span>
                                @endif

                            </span>

                        </div>

                    </div>

                </div>

                {{-- CARD --}}
                <div class="col-md-6 mb-4">

                    <div class="info-box bg-light border rounded">

                        <span class="info-box-icon bg-secondary">
                            <i class="fas fa-lock"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Card Ending
                            </span>

                            <span class="info-box-number">
                                **** {{ $payment->card_number }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <div class="text-right mt-4">

                <a href="{{ route('payments.index') }}" class="btn btn-secondary px-4">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Back

                </a>

            </div>

        </div>

    </div>

@stop
