<div class="payment-section payment-reference-section">
    <div class="payment-section-header">
        <div class="payment-section-title">
            <div class="payment-section-icon">
                <i class="fas fa-fingerprint"></i>
            </div>
            <div>
                <h4>Transaction & Reference</h4>
                <p>Payment identification information</p>
            </div>
        </div>
    </div>

    <div class="reference-grid">

        <div class="reference-card">
            <div class="reference-icon">
                <i class="fas fa-hashtag"></i>
            </div>
            <div>
                <span>Transaction ID</span>
                <strong>{{ $payment->transaction_id ?? 'N/A' }}</strong>
            </div>
        </div>

        <div class="reference-card">
            <div class="reference-icon">
                <i class="fas fa-link"></i>
            </div>
            <div>
                <span>Payment Reference</span>
                <strong>{{ $payment->payment_reference ?? 'N/A' }}</strong>
            </div>
        </div>
    </div>
</div>