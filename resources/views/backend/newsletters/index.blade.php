@extends('adminlte::page')

@section('title', 'Newsletter Subscribers')

@section('content')

    <div class="card">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Newsletter Subscribers</h5>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Domain</th>
                        <th>Subscribed At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($newsletters as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->domain }}</td>
                            <td>{{ $item->created_at->format('d M Y,  H:i:s A') }}</td>
                            <td>
                                <a href="{{ route('newsletters.show', $item->id) }}" class="btn btn-sm btn-info">
                                    View
                                </a>

                                <form action="{{ route('newsletters.destroy', $item->id) }}" method="POST" class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            {{ $newsletters->links() }}

        </div>

    </div>

@endsection
