@extends('adminlte::page')

@section('title', 'Contact Details')
@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold mb-0"><i class="fas fa-calendar-check text-primary mr-2"></i>Contact Details</h1>
        <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Back</a>
    </div>
@stop
@section('content') <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Contact Message Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"> <label>Name</label> <input type="text" class="form-control"
                                    value="{{ $contact->name }}" readonly> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> <label>Email Address</label> <input type="text" class="form-control"
                                    value="{{ $contact->email ?? 'N/A' }}" readonly> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> <label>Phone Number</label> <input type="text" class="form-control"
                                    value="{{ $contact->phone ?? 'N/A' }}" readonly> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> <label>Department</label> <input type="text" class="form-control"
                                    value="{{ $contact->department ?? 'N/A' }}" readonly> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> <label>Service</label> <input type="text" class="form-control"
                                    value="{{ $contact->service ?? 'N/A' }}" readonly> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"> <label>Submitted At</label> <input type="text" class="form-control"
                                    value="{{ $contact->created_at ? $contact->created_at->format('d M Y, h:i A') : 'N/A' }}"
                                    readonly> </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group"> <label>Patient Message</label>
                                <textarea class="form-control" rows="7" readonly>{{ $contact->message ?? 'No Message Available' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right"> <a href="{{ route('contacts.index') }}" class="btn btn-secondary"> <i
                            class="fas fa-arrow-left mr-1"></i>
                        Back </a> </div>
            </div>
        </div>
    </div>
@stop
