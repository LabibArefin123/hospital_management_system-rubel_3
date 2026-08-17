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

                <h4>Enter Card Details</h4>

                {{-- ERROR --}}
                @if (session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('payment.store') }}">
                    @csrf

                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                    <input type="hidden" name="amount" value="{{ $appointment->amount }}">

                    <!-- CARD -->
                    <div class="form-group">
                        <label>Card Number</label>
                        <input type="text" name="card_number" value="{{ old('card_number') }}"
                            placeholder="1234 5678 9012 3456">
                        @error('card_number')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- EXPIRY -->
                    <div class="form-row">
                        <div class="form-group">
                            <label>Expiry</label>
                            <input type="text" name="expiry" value="{{ old('expiry') }}" placeholder="MM/YY">
                            @error('expiry')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- CVV -->
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="text" name="cvv" value="{{ old('cvv') }}" placeholder="123">
                            @error('cvv')
                                <small class="error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="pay-btn">
                        Pay ৳{{ $appointment->amount }}
                    </button>

                </form>

            </div>

        </div>

    </div>

    @include('frontend.custom_layout.footer')
@endsection
