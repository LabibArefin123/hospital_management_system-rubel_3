<div class="card profile-main-card border-0 shadow-sm">
    <div class="profile-cover"></div>
    <div class="card-body profile-main-body">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 text-center">
                <div class="profile-avatar-wrapper">
                    <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('uploads/images/default.jpg') }}"
                        alt="{{ $user->name }}" class="profile-avatar">
                    <span class="profile-online-dot"></span>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 mt-3 mt-md-0">
                <div class="profile-name-row">
                    <h2 class="profile-name mb-1">{{ $user->name }}</h2>
                    <span class="profile-role-badge {{ $roleClass }}">
                        <i class="{{ $roleIcon }} mr-1"></i>
                        {{ $roleName }}
                    </span>
                </div>
                <p class="profile-username mb-2">
                    <i class="fas fa-at mr-1"></i>
                    {{ $user->username }}
                </p>
                <div class="profile-email">
                    <i class="fas fa-envelope mr-2"></i>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-lg-3 col-md-3 mt-3 mt-md-0">
                <div class="profile-account-status">
                    <div class="profile-status-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <small>ACCOUNT STATUS</small>
                        <strong>Active</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
