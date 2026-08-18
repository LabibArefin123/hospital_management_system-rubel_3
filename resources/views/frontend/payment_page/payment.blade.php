@extends('frontend.layouts.app')

@section('content')
    @include('frontend.custom_layout.header')
    <div class="payment-container">
        <div class="payment-grid">
            <!-- ================= LEFT: SUMMARY ================= -->
            <div class="payment-summary">
                <h4>Contact Information</h4>
                <div class="contact-info">
                    <p>
                        <strong>Patient Name:</strong>
                        {{ $appointment->name }}
                    </p>
                    <p>
                        <strong>Email Address:</strong>
                        {{ $appointment->email ?? 'No Email Provided' }}
                    </p>
                    <p>
                        <strong>Phone Number:</strong>
                        {{ $appointment->phone }}
                    </p>
                    <p>
                        <strong>Appointment Date:</strong>
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                    </p>
                    <p>
                        <strong>Appointment Time:</strong>
                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i:s A') }}
                    </p>
                </div>

                <hr>

                <h4>Payment Summary</h4>
                @if ($appointment->type === 'doctor')
                    <p>
                        <strong>Doctor:</strong>
                        {{ $appointment->doctor->name }}
                    </p>
                    <p>
                        <strong>Speciality:</strong>
                        {{ $appointment->doctor->speciality }}
                    </p>
                    <p>
                        <strong>Consultation Fee:</strong>
                        {{ $appointment->amount }} BDT
                    </p>
                @else
                    <p>
                        <strong>Service:</strong>
                        {{ $appointment->service->title }}
                    </p>
                    <p>
                        <strong>Price:</strong>
                        {{ $appointment->amount }} BDT
                    </p>
                @endif
                <hr>

                <div class="total">
                    <span>Total Payable</span>
                    <span>{{ $appointment->amount }} Taka</span>
                </div>
            </div>
            <!-- ================= RIGHT: FORM ================= -->
            <div class="payment-form-card">
                <div class="payment-form-header">
                    <div>
                        <h4>Complete Payment</h4>
                        <p>Select your preferred payment method</p>
                    </div>

                    <div class="payment-amount">
                        <span>Amount</span>
                        <strong>৳{{ number_format($appointment->amount, 2) }}</strong>
                    </div>
                </div>

                {{-- ERROR --}}
                @if (session('error'))
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('payment.store') }}" id="paymentForm">
                    @csrf

                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                    <input type="hidden" name="amount" value="{{ $appointment->amount }}">
                    <input type="hidden" name="payment_method" id="paymentMethod" value="bkash">

                    {{-- PAYMENT METHODS --}}
                    <div class="payment-method-selector">

                        <button type="button" class="payment-method-tab active" data-payment-method="bkash">
                            <span class="payment-method-icon bkash-icon">
                                <span>bKash</span>
                            </span>
                            <span class="payment-method-info">
                                <strong>bKash</strong>
                                <small>Mobile Payment</small>
                            </span>
                            <span class="payment-method-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>

                        <button type="button" class="payment-method-tab" data-payment-method="nagad">
                            <span class="payment-method-icon nagad-icon">
                                <span>Nagad</span>
                            </span>
                            <span class="payment-method-info">
                                <strong>Nagad</strong>
                                <small>Mobile Payment</small>
                            </span>
                            <span class="payment-method-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>

                        <button type="button" class="payment-method-tab" data-payment-method="rocket">
                            <span class="payment-method-icon rocket-icon">
                                <span>Rocket</span>
                            </span>
                            <span class="payment-method-info">
                                <strong>Rocket</strong>
                                <small>Mobile Payment</small>
                            </span>
                            <span class="payment-method-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>

                    </div>

                    {{-- PAYMENT INFORMATION --}}
                    <div class="payment-method-content">

                        <div class="payment-method-panel active" data-payment-panel="bkash">

                            <div class="payment-instruction">
                                <div class="payment-instruction-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>

                                <div>
                                    <strong>Pay with bKash</strong>
                                    <p>
                                        Complete the payment using your bKash account,
                                        then enter the transaction ID and payment reference below.
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="payment-method-panel" data-payment-panel="nagad">

                            <div class="payment-instruction">
                                <div class="payment-instruction-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>

                                <div>
                                    <strong>Pay with Nagad</strong>
                                    <p>
                                        Complete the payment using your Nagad account,
                                        then enter the transaction ID and payment reference below.
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="payment-method-panel" data-payment-panel="rocket">

                            <div class="payment-instruction">
                                <div class="payment-instruction-icon">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>

                                <div>
                                    <strong>Pay with Rocket</strong>
                                    <p>
                                        Complete the payment using your Rocket account,
                                        then enter the transaction ID and payment reference below.
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="form-group payment-transaction-group">
                            <label for="transaction_id">
                                Transaction ID
                            </label>

                            <div class="payment-input-wrapper">
                                <i class="fas fa-receipt"></i>

                                <input type="text" id="transaction_id" name="transaction_id"
                                    value="{{ $transactionId }}" placeholder="Enter your transaction ID" autocomplete="off"
                                    required readonly>
                            </div>

                            @error('transaction_id')
                                <small class="error">{{ $message }}</small>
                            @enderror

                            <small class="payment-input-help">
                                Your unique transaction ID has been generated automatically.
                            </small>
                        </div>

                        <div class="form-group payment-transaction-group">
                            <label for="payment_reference">
                                Payment Reference
                            </label>

                            <div class="payment-input-wrapper">
                                <i class="fas fa-hashtag"></i>

                                <input type="text" id="payment_reference" name="payment_reference"
                                    value="{{ old('payment_reference') }}" placeholder="Enter your payment reference"
                                    autocomplete="off" required>
                            </div>

                            @error('payment_reference')
                                <small class="error">{{ $message }}</small>
                            @enderror

                            <small class="payment-input-help">
                                Enter the payment reference received after completing your payment.
                            </small>
                        </div>

                    </div>

                    <button type="submit" class="pay-btn">
                        <i class="fas fa-lock mr-2"></i>
                        Confirm Payment
                        <span>৳{{ number_format($appointment->amount, 2) }}</span>
                    </button>

                </form>
            </div>
        </div>
    </div>

    @include('frontend.custom_layout.footer')
@endsection
