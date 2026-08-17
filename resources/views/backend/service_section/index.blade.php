@extends('adminlte::page')

@section('title', 'Services')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1><i class="fas fa-concierge-bell text-primary"></i> Services</h1>

        <a href="{{ route('services.create') }}" class="btn btn-primary">
            Add Service
        </a>
    </div>
@stop

@section('content')

    <div class="card shadow">

        <div class="card-body table-responsive">

           <table class="table table-striped table-hover align-middle" id="datatables">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($services as $service)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <img src="{{ asset($service->image) }}" width="70" height="70"
                                    style="object-fit:cover;border-radius:8px;">
                            </td>

                            <td>{{ $service->title }}</td>

                            <td>৳ {{ number_format($service->price, 2) }}</td>

                            <td>
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
@stop
