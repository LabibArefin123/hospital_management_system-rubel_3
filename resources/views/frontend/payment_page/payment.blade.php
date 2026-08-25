@extends('frontend.layouts.app')

@section('content')
    @include('frontend.custom_layout.header')
    <div class="payment-container">
        <div class="payment-grid">
            <!-- ================= LEFT: SUMMARY ================= -->
            @include('frontend.payment_page.partials.summary_part')
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
                        @include('frontend.payment_page.partials.type.bkash_part')
                        @include('frontend.payment_page.partials.type.nagad_part')
                        @include('frontend.payment_page.partials.type.rocket_part')
                        <div class="form-group payment-transaction-group">
                            <label for="transaction_id">Transaction ID </label>

                            <div class="payment-input-wrapper">
                                <i class="fas fa-receipt"></i>

                                <input type="text" id="transaction_id" name="transaction_id" value="{{ $transactionId }}"
                                    placeholder="Enter your transaction ID" autocomplete="off" readonly>
                            </div>

                            @error('transaction_id')
                                <small class="error">{{ $message }}</small>
                            @enderror

                            <small class="payment-input-help">
                                Your unique transaction ID has been generated automatically.
                            </small>
                            {{-- 
                            <small class="payment-input-help">
                                Undercover in the mafia's queen bed
                            </small> 
                            
                            --}}
                        </div>

                        <div class="form-group payment-transaction-group">
                            <label for="payment_reference">Payment Reference</label>

                            <div class="payment-input-wrapper">
                                <i class="fas fa-hashtag"></i>

                                <input type="text" id="payment_reference" name="payment_reference"
                                    value="{{ old('payment_reference') }}" placeholder="Enter your payment reference"
                                    autocomplete="off">
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
