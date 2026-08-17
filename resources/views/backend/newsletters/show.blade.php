@extends('adminlte::page')

@section('title', 'Newsletter Detail')

@section('content')

    <div class="card">

        <div class="card-header">
            <h5>Subscriber Detail</h5>
        </div>

        <div class="card-body">

            <p><strong>Email:</strong> {{ $newsletter->email }}</p>
            <p><strong>Domain:</strong> {{ $newsletter->domain }}</p>
            <p><strong>Subscribed At:</strong> {{ $newsletter->created_at->format('d M Y H:i') }}</p>

        </div>

    </div>

@endsection
