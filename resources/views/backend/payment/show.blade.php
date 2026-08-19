@extends('adminlte::page')

@section('title', 'Payment Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="font-weight-bold mb-0">
                Payment Details
            </h1>
            <small class="text-muted d-block mt-1">
                Transaction and appointment information
            </small>
        </div>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- PATIENT --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Patient Name</label>
                        <div class="form-control bg-light">
                            {{ optional($payment->appointment)->name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                {{-- PHONE --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Patient Phone</label>
                        <div class="form-control bg-light">
                            {{ optional($payment->appointment)->phone ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                {{-- EMAIL --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Patient Email</label>
                        <div class="form-control bg-light">
                            {{ optional($payment->appointment)->email ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                {{-- APPOINTMENT --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Appointment</label>
                        <div class="form-control bg-light">
                            @if ($payment->appointment)
                                #{{ $payment->appointment->id }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
                {{-- APPOINTMENT TYPE --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Appointment Type</label>
                        <div class="form-control bg-light">
                            @if ($payment->appointment)
                                {{ ucfirst($payment->appointment->type) }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
                {{-- DOCTOR / SERVICE --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Doctor / Service</label>
                        <div class="form-control bg-light">
                            @if ($payment->appointment)
                                @if ($payment->appointment->type === 'doctor' && $payment->appointment->doctor)
                                    {{ $payment->appointment->doctor->name }}
                                @elseif($payment->appointment->type === 'service' && $payment->appointment->service)
                                    {{ $payment->appointment->service->name }}
                                @else
                                    N/A
                                @endif
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
                {{-- APPOINTMENT DATE --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Appointment Date</label>
                        <div class="form-control bg-light">
                            {{ optional($payment->appointment)->appointment_date
                                ? \Carbon\Carbon::parse($payment->appointment->appointment_date)->format('d M Y')
                                : 'N/A' }}
                        </div>
                    </div>
                </div>
                {{-- APPOINTMENT TIME --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Appointment Time</label>
                        <div class="form-control bg-light">
                            {{ optional($payment->appointment)->appointment_time
                                ? \Carbon\Carbon::parse($payment->appointment->appointment_time)->format('h:i A')
                                : 'N/A' }}
                        </div>
                    </div>
                </div>
                {{-- APPOINTMENT STATUS --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Appointment Status</label>
                        <div class="form-control bg-light">
                            @if ($payment->appointment && $payment->appointment->status === 'confirmed')
                                <span class="badge badge-success px-3 py-2">Confirmed</span>
                            @elseif($payment->appointment && $payment->appointment->status === 'pending')
                                <span class="badge badge-warning px-3 py-2">Pending</span>
                            @else
                                <span class="badge badge-secondary px-3 py-2">
                                    {{ ucfirst($payment->appointment->status ?? 'N/A') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- AMOUNT --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Paid Amount</label>
                        <div class="form-control bg-light font-weight-bold text-success">
                            ৳{{ number_format($payment->amount, 2) }}
                        </div>
                    </div>
                </div>
                {{-- PAYMENT METHOD --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Payment Method</label>
                        <div class="form-control bg-light">
                            @php
                                $method = strtolower($payment->payment_method ?? '');
                            @endphp
                            @if ($method === 'bkash')
                                <span class="badge badge-primary px-3 py-2">bKash</span>
                            @elseif($method === 'nagad')
                                <span class="badge badge-warning px-3 py-2">Nagad</span>
                            @elseif($method === 'rocket')
                                <span class="badge badge-info px-3 py-2">Rocket</span>
                            @else
                                <span class="badge badge-secondary px-3 py-2">
                                    {{ ucfirst($payment->payment_method ?? 'N/A') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- PAYMENT STATUS --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Payment Status</label>
                        <div class="form-control bg-light">
                            @if ($payment->status === 'paid')
                                <span class="badge badge-success px-3 py-2">Paid</span>
                            @elseif($payment->status === 'failed')
                                <span class="badge badge-danger px-3 py-2">Failed</span>
                            @else
                                <span class="badge badge-warning px-3 py-2">Pending</span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- TRANSACTION ID --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Transaction ID</label>
                        <div class="form-control bg-light">
                            {{ $payment->transaction_id ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                {{-- PAYMENT REFERENCE --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Payment Reference</label>
                        <div class="form-control bg-light">
                            {{ $payment->payment_reference ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                {{-- PAYMENT DATE --}}
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Payment Date</label>
                        <div class="form-control bg-light">
                            {{ optional($payment->created_at)->format('d M Y, h:i A') ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
