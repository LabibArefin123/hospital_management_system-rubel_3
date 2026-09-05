<div class="payment-table-card">
    <div class="payment-table-header">
        <div>
            <h3>All Payments</h3>
            <p>Transaction history and payment details</p>
        </div>
        <span class="payment-total-badge">
            <i class="fas fa-receipt mr-1"></i>
            {{ $payments->total() }} Payments
        </span>
    </div>

    <div class="table-responsive">
        <table class="table payment-table" id="dataTables">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient</th>
                    <th>Appointment</th>
                    <th>Doctor / Service</th>
                    <th>Transaction ID</th>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th >Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $payment->patient_name }}</strong>
                            @if ($payment->patient_phone)
                                <small class="d-block text-muted">
                                    {{ $payment->patient_phone }}
                                </small>
                            @endif
                        </td>

                        <td>
                            <span class="appointment-number">
                                {{ $payment->appointment_number }}
                            </span>
                        </td>

                        <td>
                            <div class="provider-cell">
                                <div class="provider-image">
                                    <img src="{{ $payment->provider_image_url }}" alt="{{ $payment->provider_name }}">
                                </div>
                                <div class="provider-details">
                                    <strong>{{ $payment->provider_name }}</strong>
                                    <small>{{ $payment->provider_type }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="transaction-id">
                                {{ $payment->transaction_display }}
                            </span>
                        </td>

                        <td>
                            <span class="payment-reference">
                                {{ $payment->reference_display }}
                            </span>
                        </td>

                        <td>
                            <strong class="payment-amount">
                                ৳{{ $payment->formatted_amount }}
                            </strong>
                        </td>

                        <td>
                            <span class="payment-method-badge badge-{{ $payment->method_badge }}">
                                {{ $payment->method_label }}
                            </span>
                        </td>

                        <td>
                            <span class="payment-status-badge payment-status-{{ $payment->status_badge }}">
                                {{ $payment->status_label }}
                            </span>
                        </td>

                        <td>
                            <span>{{ $payment->formatted_date }}</span>
                            <small class="d-block text-muted">
                                {{ $payment->formatted_time }}
                            </small>
                        </td>

                        <td>
                            <div class="payment-actions">
                                <a href="{{ route('payments.show', $payment->id) }}"
                                    class="payment-action-btn payment-view-btn" title="View Payment">
                                    <i class="fas fa-eye"></i>
                                    <span>View Payment</span>
                                </a>

                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="payment-action-btn payment-delete-btn"
                                        title="Delete Payment" onclick="return confirm('Delete this payment?')">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete Payment</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">
                            <div class="payment-empty-state">
                                <div class="payment-empty-icon">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <strong>No Payment Records</strong>
                                <span>There are currently no payment transactions to display.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($payments->hasPages())
        <div class="payment-pagination">
            {{ $payments->links() }}
        </div>
    @endif
</div>
