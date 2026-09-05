<div class="payment-section payment-information-section">
    <div class="payment-section-header">
        <div class="payment-section-title">
            <div class="payment-section-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div>
                <h4>Payment Information</h4>
                <p>Payment amount, method and current status</p>
            </div>
        </div>
    </div>

    <div class="payment-summary">

        <div class="payment-amount-card">
            <span>Paid Amount</span>
            <strong>৳{{ $payment->formatted_amount }}</strong>
        </div>

        <div class="payment-info-grid">

            <div class="payment-info-item">
                <span class="payment-info-label">
                    <i class="fas fa-wallet mr-1"></i>
                    Payment Method
                </span>
                <span class="payment-method-badge badge-{{ $payment->method_badge }}">
                    {{ $payment->method_label }}
                </span>
            </div>

            <div class="payment-info-item">
                <span class="payment-info-label">
                    <i class="fas fa-circle-check mr-1"></i>
                    Payment Status
                </span>
                <span class="payment-status-badge payment-status-{{ $payment->status_badge }}">
                    {{ $payment->status_label }}
                </span>
            </div>

            <div class="payment-info-item">
                <span class="payment-info-label">
                    <i class="fas fa-calendar-day mr-1"></i>
                    Payment Date
                </span>
                <strong>{{ $payment->formatted_created_at ?? 'N/A' }}</strong>
            </div>
        </div>
    </div>
</div>
