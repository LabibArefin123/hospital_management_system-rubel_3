@extends('frontend.layouts.app')

@section('title', 'Search Patient / Doctor - SusthoCare')

@section('content')

    @include('frontend.custom_layout.header')

    {{-- =========================================================
        SEARCH INTRO
    ========================================================== --}}

    <section class="doctor-intro">
        <div class="container text-center">

            <h2>
                <i class="fas fa-search mr-2"></i>
                Search Our System
            </h2>

            <p>
                Search patients or doctors by name, phone, code or speciality
            </p>

            <div class="search-page-input-wrapper">

                <i class="fas fa-search"></i>

                <input type="text" id="systemSearchPageInput" value="{{ $search ?? '' }}"
                    placeholder="Search patient name, phone, code, doctor or speciality..." autocomplete="off">

                <button type="button" id="systemSearchPageClear">
                    <i class="fas fa-times"></i>
                </button>

            </div>

        </div>
    </section>


    {{-- =========================================================
        SEARCH RESULTS
    ========================================================== --}}

    <section class="doctor-section py-5">

        <div class="container">

            {{-- Loading --}}
            <div id="searchPageLoading" class="text-center py-5 d-none">

                <i class="fas fa-spinner fa-spin fa-2x text-danger"></i>

                <p class="mt-3 text-muted">
                    Searching...
                </p>

            </div>


            {{-- Empty --}}
            <div id="searchPageEmpty" class="text-center py-5 d-none">

                <i class="fas fa-search fa-3x text-muted mb-3"></i>

                <h5>
                    No Result Found
                </h5>

                <p class="text-muted">
                    No patient or doctor matched your search.
                </p>

            </div>
        </div>
    </section>
    @include('frontend.custom_layout.footer')
@endsection
1