@extends('adminlte::page')

@section('title', 'User Dashboard')

@section('content_header')
    @include('backend.dashboard.custom_header.user')
@stop

@section('content')
{{-- ================= STATS CARD PART ================= --}}
    @include('backend.dashboard.partials.user_part.card-box')
    {{-- ================= PAYMENT PART================= --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5>Total Paid</h5>
            <h3 class="text-success">৳{{ number_format($totalPaid, 2) }}</h3>
        </div>
    </div>
    {{-- ================= LATEST APPOINTMENTS ================= --}}
    @include('backend.dashboard.partials.user_part.latest_appointment')

    {{-- ================= ALL APPOINTMENTS ================= --}}
    @include('backend.dashboard.partials.user_part.all_appointment')
@endsection
