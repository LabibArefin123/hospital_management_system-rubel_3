@extends('adminlte::page')

@section('title', 'Contact Details')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/show_page/contact_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/show_page/contact_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/show_page/contact_info.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/show_page/contact_message.css') }}">
@stop

@section('content_header')
    <div class="contact-show-header">
        <h1 class="contact-show-title">
            <i class="fas fa-envelope-open-text"></i>
            Contact Details
        </h1>

        <a href="{{ route('contacts.index') }}" class="btn btn-secondary contact-show-back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card contact-show-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-comment-alt"></i>
                        Contact Message Details
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-detail-group">
                                <label class="contact-detail-label"> Name</label>
                                <div class="contact-detail-value">
                                    <i class="fas fa-user"></i>
                                    {{ $contact->name }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="contact-detail-group">
                                <label class="contact-detail-label">Email Address</label>
                                <div class="contact-detail-value {{ !$contact->email ? 'muted' : '' }}">
                                    <i class="fas fa-envelope"></i>
                                    {{ $contact->email ?? 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="contact-detail-group">
                                <label class="contact-detail-label">Phone Number</label>
                                <div class="contact-detail-value {{ !$contact->phone ? 'muted' : '' }}">
                                    <i class="fas fa-phone-alt"></i>
                                    {{ $contact->phone ?? 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="contact-detail-group">
                                <label class="contact-detail-label">Department</label>
                                <div class="contact-detail-value {{ !$contact->department ? 'muted' : '' }}">
                                    <i class="fas fa-building"></i>
                                    {{ $contact->department ?? 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="contact-detail-group">
                                <label class="contact-detail-label">Service</label>
                                <div class="contact-detail-value {{ !$contact->service ? 'muted' : '' }}">
                                    <i class="fas fa-concierge-bell"></i>
                                    {{ $contact->service ?? 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="contact-detail-group">
                                <label class="contact-detail-label">Submitted At</label>
                                <div class="contact-detail-value">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $contact->created_at ? $contact->created_at->format('d M Y, h:i A') : 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="contact-message-section">
                                <label class="contact-message-label">Patient Message</label>
                                <textarea class="form-control contact-message-box" rows="7" readonly>{{ $contact->message ?? 'No Message Available' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('contacts.index') }}" class="btn btn-secondary contact-show-footer-btn">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back to Messages
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
