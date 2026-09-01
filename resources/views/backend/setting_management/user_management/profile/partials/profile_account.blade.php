<div class="card profile-section-card border-0 shadow-sm mt-4">
    <div class="card-header profile-section-header">
        <div class="profile-section-title">
            <div class="profile-section-icon account-icon">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <h5 class="mb-0">Account Information</h5>
                <small class="text-muted">{{ $roleHeader }} and personal account details</small>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="profile-detail-box">
                    <span>
                        <i class="fas fa-user mr-2"></i>
                        Full Name
                    </span>
                    <strong>{{ $user->name }}</strong>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="profile-detail-box">
                    <span>
                        <i class="fas fa-at mr-2"></i>
                        Username
                    </span>
                    <strong>{{ $user->username }}</strong>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="profile-detail-box">
                    <span>
                        <i class="fas fa-envelope mr-2"></i>
                        Email Address
                    </span>
                    <strong>{{ $user->email }}</strong>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="profile-detail-box">
                    <span>
                        <i class="fas fa-phone mr-2"></i>
                        Phone Number
                    </span>
                    <strong>{{ $user->phone ?? 'Not Provided' }}</strong>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="profile-detail-box">
                    <span>
                        <i class="fas fa-mobile-alt mr-2"></i>
                        Secondary Phone
                    </span>
                    <strong>{{ $user->phone_2 ?? 'Not Provided' }}</strong>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="profile-detail-box">
                    <span>
                        <i class="{{ $roleIcon }} mr-2"></i>
                        Account Role
                    </span>
                    <strong>{{ $roleName }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="profile-role-message {{ $roleMessageClass }} mt-4">
    <div class="profile-message-icon">
        <i class="{{ $roleIcon }}"></i>
    </div>
    <div>
        <strong>{{ $roleMessageTitle }}</strong>
        <p class="mb-0">{{ $roleMessage }}</p>
    </div>
</div>
