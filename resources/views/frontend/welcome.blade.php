@extends('frontend.layouts.app')

@section('title', 'SusthoCare - Healthcare Solutions')

@section('content')
    {{-- Header --}}
    @include('frontend.custom_layout.header')

    @include('frontend.welcome_page.banner')
    @include('frontend.welcome_page.certify')
    @include('frontend.welcome_page.doctor')
    @include('frontend.welcome_page.trust')
    {{-- Footer --}}
    @include('frontend.custom_layout.footer')
@endsection
