@extends('adminlte::page')

@section('title', 'Payment Records')

@section('content_header')
    <h1 class="font-weight-bold">
        Payment Records
    </h1>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold mb-0">All Payments</h3>
                <span class="badge badge-success p-2">Total: {{ $payments->count() }}</span>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover align-middle" id="datatables">
                <thead class="bg-light">
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
                        <th>Date</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $key => $payment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <strong>{{ optional($payment->user)->name ?? 'Guest User' }}</strong>
                                @if (optional($payment->user)->phone)
                                    <small class="d-block text-muted">{{ $payment->user->phone }}</small>
                                @endif
                            </td>
                            <td>
                                @if ($payment->appointment)
                                    <span class="text-primary font-weight-bold">#{{ $payment->appointment->id }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if ($payment->appointment)
                                    @if ($payment->appointment->type === 'doctor' && $payment->appointment->doctor)
                                        <strong>{{ $payment->appointment->doctor->name }}</strong>
                                        <small class="d-block text-muted">Doctor</small>
                                    @elseif($payment->appointment->type === 'service' && $payment->appointment->service)
                                        <strong>{{ $payment->appointment->service->name }}</strong>
                                        <small class="d-block text-muted">Service</small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-primary font-weight-bold">
                                    {{ $payment->transaction_id ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-dark">
                                    {{ $payment->payment_reference ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <strong class="text-success">
                                    ৳{{ number_format($payment->amount, 2) }}
                                </strong>
                            </td>
                            <td>
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
                            </td>
                            <td>
                                @if ($payment->status === 'paid')
                                    <span class="badge badge-success px-3 py-2">Paid</span>
                                @elseif($payment->status === 'failed')
                                    <span class="badge badge-danger px-3 py-2">Failed</span>
                                @else
                                    <span class="badge badge-warning px-3 py-2">Pending</span>
                                @endif
                            </td>
                            <td>
                                {{ optional($payment->created_at)->format('d M Y') }}
                                <small class="d-block text-muted">
                                    {{ optional($payment->created_at)->format('h:i A') }}
                                </small>
                            </td>
                            <td>
                                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm"
                                    title="View Payment">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Payment"
                                        onclick="return confirm('Delete this payment?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">
                                No payment records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
@stop
