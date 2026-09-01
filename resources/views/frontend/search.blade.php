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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{--  System Search Start --}}
    {{-- STATE 1 --}}
    <script src="{{ asset('js/custom_frontend/system_search/system_search_core.js') }}"></script>
    {{-- STATE 2 --}}
    <script src="{{ asset('js/custom_frontend/system_search/system_search_events.js') }}"></script>
    {{-- STATE 3 --}}
    <script src="{{ asset('js/custom_frontend/system_search/system_search_api.js') }}"></script>
    {{-- STATE 4A - 4D --}}
    <script src="{{ asset('js/custom_frontend/system_search/render_part/system_search_render_status.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/render_part/system_search_render_item.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/render_part/system_search_render_containers.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/render_part/system_search_render_appointments.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/render_part/system_search_render_doctors.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/render_part/system_search_render_results.js') }}"></script>
    {{-- STATE 5 - Renderer Core --}}
    <script src="{{ asset('js/custom_frontend/system_search/render_part/system_search_render_core.js') }}"></script>
    {{-- STATE 6A - 6D --}}
    <script src="{{ asset('js/custom_frontend/system_search/ui_part/system_search_ui_loading.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/ui_part/system_search_ui_empty.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/ui_part/system_search_ui_clear.js') }}"></script>
    <script src="{{ asset('js/custom_frontend/system_search/ui_part/system_search_ui_helpers.js') }}"></script>
    {{-- STATE 7 --}}
    <script src="{{ asset('js/custom_frontend/system_search/system_search_init.js') }}"></script>
    {{--  System Search End --}}
@endsection
