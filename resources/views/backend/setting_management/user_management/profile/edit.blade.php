@extends('adminlte::page')

@section('title', 'Edit User Profile')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_page_header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_inputs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_password.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_actions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/profile_picture/edit_profile_image.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/profile_page/edit_page/profile_picture/edit_profile_image_header.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/profile_page/edit_page/profile_picture/edit_profile_image_current.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/backend/profile_page/edit_page/profile_picture/edit_profile_image_upload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend/profile_page/edit_page/edit_profile_responsive.css') }}">
@stop

@section('content_header')
    <div class="profile-edit-page-header">
        <div class="profile-edit-header-content">
            <div class="profile-edit-header-icon">
                <i class="fas fa-user-edit"></i>
            </div>

            <div class="profile-edit-header-title">
                <h1>Edit Profile</h1>
                <p>Update your personal and account information</p>
            </div>
        </div>

        <a href="{{ route('system_users.user_profile_show') }}" class="btn btn-light profile-edit-back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Profile
        </a>
    </div>
@stop

@section('content')
    <div class="profile-edit-card">
        @include('backend.setting_management.user_management.profile.partials.edit_page.table_header')
        <div class="profile-edit-card-body">
            @include('backend.setting_management.user_management.profile.partials.edit_page.error_message')
            <form action="{{ route('system_users.user_profile_update') }}" method="POST" enctype="multipart/form-data"
                id="profileUpdateForm">
                @csrf
                @method('PUT')
                {{-- PERSONAL INFORMATION --}}
                @include('backend.setting_management.user_management.profile.partials.edit_page.part_1')
                {{-- PROFILE PICTURE --}}
                @include('backend.setting_management.user_management.profile.partials.edit_page.part_2')
                {{-- PASSWORD --}}
                @include('backend.setting_management.user_management.profile.partials.edit_page.part_3')
                {{-- ACTIONS --}}
                @include('backend.setting_management.user_management.profile.partials.edit_page.action_part')
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/custom_backend/setting_management/system_user/profile_page/edit_page/image_preview.js') }}">
    </script>
@endsection
