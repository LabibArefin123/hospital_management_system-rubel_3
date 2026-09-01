@extends('adminlte::page')

@section('title', 'User Profile')

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('css/backend/profile_page/show_page/profile_header.css') }}">
<link rel="stylesheet" href="{{ asset('css/backend/profile_page/show_page/profile_main.css') }}">
<link rel="stylesheet" href="{{ asset('css/backend/profile_page/show_page/profile_role.css') }}">
<link rel="stylesheet" href="{{ asset('css/backend/profile_page/show_page/profile_sections.css') }}">
<link rel="stylesheet" href="{{ asset('css/backend/profile_page/show_page/profile_info.css') }}">
<link rel="stylesheet" href="{{ asset('css/backend/profile_page/show_page/profile_details.css') }}">
@stop

@section('content_header')
    <div class="profile-page-header">
        <div>
            <div class="d-flex align-items-center mb-1">
                <div class="profile-header-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div>
                    <h1 class="mb-0 font-weight-bold">My Profile</h1>
                    <small class="text-muted">Manage your account information and profile details</small>
                </div>
            </div>
        </div>

        <a id="editProfileBtn" data-profile-url="{{ route('system_users.user_profile_edit') }}"
            class="btn btn-warning profile-edit-btn">
            <i class="fas fa-edit mr-1"></i>
            Edit Profile
        </a>
    </div>
@stop

@section('content')
    <div class="profile-page">
        @include('backend.setting_management.user_management.profile.partials.profile_header')
        @include('backend.setting_management.user_management.profile.partials.profile_professional')
        @include('backend.setting_management.user_management.profile.partials.profile_account')
    </div>
@endsection

@section('js')
    <script
        src="{{ asset('js/custom_backend/setting_management/system_user/profile_page/show_page/edit_confirmation.js') }}">
    </script>
@endsection
