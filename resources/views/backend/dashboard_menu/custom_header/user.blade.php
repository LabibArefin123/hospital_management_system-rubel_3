<div class="card dashboard-header-user">
    <div class="card-body dashboard-header-user-body">
        <div class="dashboard-header-user-content">
            <div class="dashboard-header-user-info">
                <h4 class="dashboard-header-user-title">Welcome, {{ $user->name }}</h4>
                <small class="dashboard-header-user-email">{{ $user->email }}</small>
            </div>
            <div class="dashboard-header-user-avatar-wrapper">
                @if ($user->avatar ?? false)
                    <img src="{{ $user->avatar }}" class="dashboard-header-user-avatar" alt="User">
                @else
                    <img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('uploads/images/default.jpg') }}"
                        class="dashboard-header-user-avatar" alt="User">
                @endif
            </div>
        </div>
    </div>
</div>
