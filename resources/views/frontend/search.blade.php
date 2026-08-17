@extends('frontend.layouts.app')

@section('title', 'Search - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    {{-- SEARCH PAGE --}}
    <section class="doctor-intro">
        <div class="container text-center">
            <h2>
                <i class="fas fa-search mr-2"></i>
                Search Our System
            </h2>

            <div class="search-page-input-wrapper">
                <i class="fas fa-search"></i>

                <input type="text" id="systemSearchPageInput" value="{{ $search ?? '' }}"
                    placeholder="Search patient or doctor..." autocomplete="off">

                <button type="button" id="systemSearchPageClear">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </section>

    {{--  SEARCH RESULTS --}}

    <section class="doctor-section py-4">
        <div class="container">
            {{-- Loading --}}
            <div id="searchPageLoading" class="text-center py-4 d-none">
                <i class="fas fa-spinner fa-spin fa-2x text-danger"></i>
            </div>

            {{-- Results --}}
            <div id="systemSearchPageResults" class="d-none"></div>

            {{-- Empty --}}
            <div id="searchPageEmpty" class="text-center py-4 d-none">
                <i class="fas fa-search fa-2x text-muted mb-2"></i>
                <h5>No Result Found</h5>
            </div>
        </div>
    </section>
    @include('frontend.custom_layout.footer')
@endsection
