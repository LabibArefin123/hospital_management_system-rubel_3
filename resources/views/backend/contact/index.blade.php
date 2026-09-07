@extends('adminlte::page')

@section('title', 'Contact Messages')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/index_page/contact_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/index_page/contact_filter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/index_page/contact_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/index_page/contact_table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/contact_page/index_page/contact_actions.css') }}">
@stop

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="font-weight-bold mb-2 mb-md-0"> Contact Messages </h1>
        <button type="button" id="toggleFilterBtn" class="btn btn-primary">
            <i class="fas fa-filter mr-1"></i> Filter <i id="filterArrow" class="fas fa-chevron-down ml-1"></i>
        </button>
    </div>
@stop

@section('content')
    {{--  FILTER SECTION --}}
    @include('backend.contact.partial_layout.part_1')
    {{--  TABLE SECTION --}}
    @include('backend.contact.partial_layout.part_2')
@stop

@section('js')
    <script src="{{ asset('js/custom_backend/contact_section/contact_filter_toggle.js') }}"></script>
    <script src="{{ asset('js/custom_backend/contact_section/contact_filter_core.js') }}"></script>
    <script src="{{ asset('js/custom_backend/contact_section/contact_filter_events.js') }}"></script>
    <script src="{{ asset('js/custom_backend/contact_section/contact_filter_init.js') }}"></script>
@stop
