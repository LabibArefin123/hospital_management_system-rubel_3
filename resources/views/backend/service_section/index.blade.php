@extends('adminlte::page')

@section('title', 'Services')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/index_page/content_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/index_page/content_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/index_page/content_action.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/service_page/index_page/content_responsive.css') }}">
@stop

@section('content_header')
    <div class="service-index-header">
        <div class="service-index-header-content">
            <h1>
                <i class="fas fa-concierge-bell"></i>
                Services
            </h1>
            <p>
                Manage your healthcare services and service schedules.
            </p>
        </div>
        <a href="{{ route('services.create') }}" class="btn btn-primary service-index-add-btn">
            <i class="fas fa-plus"></i>
            Add Service
        </a>
    </div>
@stop

@section('content')
    <div class="card service-index-card">
        <div class="card-body">
            <div class="service-index-table-wrapper">
                <table class="table service-index-table" id="dataTables">
                    <thead>
                        <tr>
                            <th class="service-index-number">#</th>
                            <th class="service-index-image-cell">Image</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th class="service-index-action-cell">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td class="service-index-number">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="service-index-image-cell">
                                    <img src="{{ $service->image ? asset($service->image) : asset('uploads/images/default.jpg') }}"
                                        alt="{{ $service->title }}" class="service-index-image">
                                </td>
                                <td>
                                    <span class="service-index-title">
                                        {{ $service->title }}
                                    </span>
                                </td>
                                <td>
                                    <span class="service-index-price">
                                        ৳ {{ number_format($service->price, 2) }}
                                    </span>
                                </td>
                                <td class="service-index-action-cell">
                                    <div class="service-index-actions d-flex align-items-center">
                                        <a href="{{ route('services.show', $service->id) }}"
                                            class="btn service-index-view-btn" title="View Service">
                                            <i class="fas fa-eye"></i>
                                            <span>View Data</span>
                                        </a>
                                        <a href="{{ route('services.edit', $service->id) }}"
                                            class="btn service-index-edit-btn" title="Edit Service">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit Data</span>
                                        </a>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                            class="service-index-delete-form"
                                            onsubmit="return confirm('Are you sure you want to delete this service?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn service-index-delete-btn"
                                                title="Delete Service">
                                                <i class="fas fa-trash"></i>
                                                <span>Delete Data</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="service-index-empty">
                                    <i class="fas fa-concierge-bell fa-2x mb-2 d-block"></i>
                                    No services found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
