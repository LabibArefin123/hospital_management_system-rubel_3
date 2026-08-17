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

                <h3 class="card-title font-weight-bold">
                    All Payments
                </h3>

                <span class="badge badge-success p-2">
                    Total: {{ $payments->count() }}
                </span>

            </div>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-striped table-hover align-middle" id="datatables">

                <thead class="bg-light">

                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Transaction</th>
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
                                <strong>
                                    {{ optional($payment->user)->name ?? 'Guest User' }}
                                </strong>
                            </td>

                            <td>

                                <span class="text-primary font-weight-bold">
                                    {{ $payment->transaction_id ?? 'N/A' }}
                                </span>

                            </td>

                            <td>

                                <strong class="text-success">
                                    ৳{{ number_format($payment->amount, 2) }}
                                </strong>

                            </td>

                            <td>

                                <span class="badge badge-info px-3 py-2">
                                    {{ $payment->payment_method }}
                                </span>

                            </td>

                            <td>

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

                            </td>

                            <td>
                                {{ $payment->created_at->format('d M Y') }}
                            </td>

                            <td>

                                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this payment?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center text-muted">
                                No payment records found
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@stop
