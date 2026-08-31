@extends('frontend.layouts.app')

@section('title', 'SusthoCare - Healthcare Solutions')

@section('content')
    {{-- Header Part --}}
    @include('frontend.custom_layout.header')
    {{-- Banner Section Part --}}
    @include('frontend.welcome_page.banner')
    {{-- Certify Section Part --}}
    @include('frontend.welcome_page.certify')
    {{-- Doctor Section Part --}}
    @include('frontend.welcome_page.doctor')
    {{-- Trust Section Part --}}
    @include('frontend.welcome_page.trust')
    {{-- Footer Part --}}
    @include('frontend.custom_layout.footer')
@endsection
