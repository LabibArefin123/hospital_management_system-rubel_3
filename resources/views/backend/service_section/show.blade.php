@extends('adminlte::page')

@section('title', 'Service Details')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h3 class="mb-0 font-weight-normal">

            Service Details

        </h3>

        <div>

            <a href="{{ route('services.index') }}" class="btn btn-outline-secondary btn-sm">

                <i class="fas fa-arrow-left mr-1"></i>

                Back

            </a>

            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-sm">

                <i class="fas fa-edit mr-1"></i>

                Edit

            </a>

        </div>

    </div>

@stop

@section('content')

    <div class="row">

        {{-- IMAGE SECTION --}}
        <div class="col-lg-4 col-md-5">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    @if ($service->image)
                        <img src="{{ asset($service->image) }}" alt="Service Image" class="img-fluid rounded border"
                            style="
                                max-height:320px;
                                width:100%;
                                object-fit:cover;
                             ">
                    @else
                        <div class="border rounded py-5 text-muted">

                            <i class="fas fa-image fa-3x mb-3"></i>

                            <p class="mb-0">

                                No Image Available

                            </p>

                        </div>
                    @endif

                </div>

            </div>

        </div>

        {{-- DETAILS SECTION --}}
        <div class="col-lg-8 col-md-7">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    {{-- TITLE --}}
                    <div class="mb-4">

                        <h2 class="font-weight-bold mb-2">

                            {{ $service->title }}

                        </h2>

                        <h4 class="text-muted mb-0">

                            ৳ {{ number_format($service->price, 2) }}

                        </h4>

                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mb-4">

                        <h5 class="mb-3">

                            Description

                        </h5>

                        <div class="border rounded p-3 bg-light">

                            {!! nl2br(e($service->description)) !!}

                        </div>

                    </div>

                    {{-- INSTRUCTIONS --}}
                    <div>

                        <h5 class="mb-3">

                            Instructions

                        </h5>

                        @if ($service->instructions && count($service->instructions))

                            <div class="border rounded">

                                @foreach ($service->instructions as $instruction)
                                    <div class="p-3 border-bottom">

                                        <i class="fas fa-check text-success mr-2"></i>

                                        {{ $instruction }}

                                    </div>
                                @endforeach

                            </div>
                        @else
                            <div class="text-muted">

                                No instructions available.

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop
