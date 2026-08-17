@extends('adminlte::page')

@section('title', 'Contact Details')

@section('content_header')
    <h1 class="font-weight-bold">
        Contact Details
    </h1>
@stop

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-0 shadow-sm">

                {{-- HEADER --}}
                <div class="card-header bg-gradient-primary border-0">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <h3 class="mb-1 text-white font-weight-bold">
                                {{ $contact->name }}
                            </h3>

                            <small class="text-light">
                                Contact Message Details
                            </small>

                        </div>

                        <div class="text-white">

                            <i class="fas fa-envelope-open-text fa-2x"></i>

                        </div>

                    </div>

                </div>

                {{-- BODY --}}
                <div class="card-body p-4">

                    <div class="row">

                        {{-- EMAIL --}}
                        <div class="col-md-6 mb-4">

                            <div class="info-box bg-light border rounded">

                                <span class="info-box-icon bg-primary elevation-1">
                                    <i class="fas fa-envelope"></i>
                                </span>

                                <div class="info-box-content">

                                    <span class="info-box-text text-muted">
                                        Email Address
                                    </span>

                                    <span class="info-box-number">
                                        {{ $contact->email ?? 'N/A' }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        {{-- PHONE --}}
                        <div class="col-md-6 mb-4">

                            <div class="info-box bg-light border rounded">

                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-phone-alt"></i>
                                </span>

                                <div class="info-box-content">

                                    <span class="info-box-text text-muted">
                                        Phone Number
                                    </span>

                                    <span class="info-box-number">
                                        {{ $contact->phone }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        {{-- DEPARTMENT --}}
                        <div class="col-md-6 mb-4">

                            <div class="info-box bg-light border rounded">

                                <span class="info-box-icon bg-info elevation-1">
                                    <i class="fas fa-hospital"></i>
                                </span>

                                <div class="info-box-content">

                                    <span class="info-box-text text-muted">
                                        Department
                                    </span>

                                    <span class="info-box-number">
                                        {{ $contact->department ?? 'N/A' }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        {{-- SERVICE --}}
                        <div class="col-md-6 mb-4">

                            <div class="info-box bg-light border rounded">

                                <span class="info-box-icon bg-warning elevation-1">
                                    <i class="fas fa-stethoscope"></i>
                                </span>

                                <div class="info-box-content">

                                    <span class="info-box-text text-muted">
                                        Service
                                    </span>

                                    <span class="info-box-number">
                                        {{ $contact->service ?? 'N/A' }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- MESSAGE --}}
                    <div class="mt-2">

                        <div class="d-flex align-items-center mb-3">

                            <i class="fas fa-comment-medical text-primary mr-2"></i>

                            <h5 class="mb-0 font-weight-bold">
                                Patient Message
                            </h5>

                        </div>

                        <div class="border rounded bg-light p-4 shadow-sm">

                            <p class="mb-0 text-dark" style="line-height: 1.9;">
                                {{ $contact->message ?? 'No Message Available' }}
                            </p>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="mt-4 text-right">

                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary px-4">

                            <i class="fas fa-arrow-left mr-1"></i>
                            Back

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
