@extends('adminlte::page')

@section('title', 'Service Details')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/show_page/content_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/show_page/content_image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/show_page/content_details.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/show_page/content_instruction.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/show_page/content_responsive.css') }}">
@stop

@section('content_header')
    <div class="service-show-header">
        <div class="service-show-header-content">
            <h3>
                <i class="fas fa-concierge-bell"></i>
                Service Details
            </h3>
        </div>
        <div class="service-show-header-actions">
            <a href="{{ route('services.index') }}" class="btn service-show-back-btn">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>
            <a href="{{ route('services.edit', $service->id) }}" class="btn service-show-edit-btn">
                <i class="fas fa-edit"></i>
                Edit
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-5 mb-3 mb-md-0">
            <div class="card service-show-image-card">
                <div class="service-show-image-header">
                    <span class="service-show-image-header-icon">
                        <i class="fas fa-image"></i>
                    </span>
                    <strong>Service Image</strong>
                </div>
                <div class="service-show-image-body">
                    @if ($service->image)
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="service-show-image">
                    @else
                        <div class="service-show-no-image">
                            <i class="fas fa-image"></i>
                            <p>No Image Available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-7">
            <div class="card service-show-details-card">
                <div class="service-show-details-body">
                    <div class="service-show-title-section">
                        <h2 class="service-show-title">
                            {{ $service->title }}
                        </h2>
                        <div class="service-show-price">
                            <i class="fas fa-tag"></i>
                            ৳ {{ number_format($service->price, 2) }}
                        </div>
                    </div>
                    <div class="service-show-section">
                        <h5 class="service-show-section-title">
                            <i class="fas fa-align-left"></i>
                            Description
                        </h5>
                        @if ($service->description)
                            <div class="service-show-description">
                                {!! nl2br(e($service->description)) !!}
                            </div>
                        @else
                            <div class="service-show-empty">
                                No description available.
                            </div>
                        @endif
                    </div>
                    <div class="service-show-section">
                        <h5 class="service-show-section-title">
                            <i class="fas fa-list-ul"></i>
                            Instructions
                        </h5>
                        @if ($service->instructions && count($service->instructions))
                            <div class="service-show-instructions">
                                @foreach ($service->instructions as $instruction)
                                    <div class="service-show-instruction">
                                        <span class="service-show-instruction-icon">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span>{{ $instruction }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="service-show-empty">
                                No instructions available.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
