    <form action="{{ route('payments.index') }}" method="GET">
        <div class="row align-items-end">

            {{-- This is for payment status --}}
            <div class="col-12 col-md-6 col-lg-2">
                <div class="payment-filter-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="paid" {{ ($filters['status'] ?? '') === 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>
                        <option value="pending" {{ ($filters['status'] ?? '') === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="failed" {{ ($filters['status'] ?? '') === 'failed' ? 'selected' : '' }}>
                            Failed
                        </option>
                    </select>
                </div>
            </div>

            {{-- This is for payment method --}}
            <div class="col-12 col-md-6 col-lg-2">
                <div class="payment-filter-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-control">
                        <option value="">All Methods</option>
                        <option value="bkash" {{ ($filters['payment_method'] ?? '') === 'bkash' ? 'selected' : '' }}>
                            bKash
                        </option>
                        <option value="nagad" {{ ($filters['payment_method'] ?? '') === 'nagad' ? 'selected' : '' }}>
                            Nagad
                        </option>
                        <option value="rocket" {{ ($filters['payment_method'] ?? '') === 'rocket' ? 'selected' : '' }}>
                            Rocket
                        </option>
                    </select>
                </div>
            </div>

            {{-- This is for appointment type --}}
            <div class="col-12 col-md-6 col-lg-2">
                <div class="payment-filter-group">
                    <label for="type">Appointment Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">All Types</option>
                        <option value="doctor" {{ ($filters['type'] ?? '') === 'doctor' ? 'selected' : '' }}>
                            Doctor
                        </option>
                        <option value="service" {{ ($filters['type'] ?? '') === 'service' ? 'selected' : '' }}>
                            Service
                        </option>
                    </select>
                </div>
            </div>

            {{-- This is for payment date --}}
            <div class="col-12 col-md-6 col-lg-2">
                <div class="payment-filter-group">
                    <label for="date">Payment Date</label>
                    <input type="date" name="date" id="date" class="form-control"
                        value="{{ $filters['date'] ?? '' }}">
                </div>
            </div>

            {{-- This is for filter actions --}}
            <div class="col-12 col-lg-4">
                <div class="payment-filter-actions">
                    <button type="submit" class="payment-filter-btn payment-filter-apply">
                        <i class="fas fa-filter"></i>
                        Apply Filter
                    </button>

                    <a href="{{ route('payments.index') }}" class="payment-filter-btn payment-filter-reset">
                        <i class="fas fa-redo"></i>
                        Reset
                    </a>
                </div>
            </div>

        </div>
    </form>
