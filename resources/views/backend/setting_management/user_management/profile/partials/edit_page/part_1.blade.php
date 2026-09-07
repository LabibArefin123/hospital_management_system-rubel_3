<div class="profile-edit-section">
    <div class="profile-edit-section-heading">
        <div class="profile-edit-section-heading-icon">
            <i class="fas fa-user"></i>
        </div>

        <div>
            <h5>Personal Information</h5>
            <small>Your basic account information</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="profile-edit-form-group">
                <label for="name" class="profile-edit-form-label">
                    <i class="fas fa-id-card"></i>
                    Full Name
                </label>

                <input type="text" name="name" id="name"
                    class="form-control profile-edit-form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" placeholder="Enter your full name">

                @error('name')
                    <span class="profile-edit-invalid">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="profile-edit-form-group">
                <label for="username" class="profile-edit-form-label">
                    <i class="fas fa-at"></i>
                    Username
                </label>

                <input type="text" name="username" id="username"
                    class="form-control profile-edit-form-control @error('username') is-invalid @enderror"
                    value="{{ old('username', $user->username) }}" placeholder="Enter username">

                @error('username')
                    <span class="profile-edit-invalid">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="profile-edit-form-group">
                <label for="email" class="profile-edit-form-label">
                    <i class="fas fa-envelope"></i>
                    Email Address
                </label>

                <input type="email" name="email" id="email"
                    class="form-control profile-edit-form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" placeholder="Enter email address">

                @error('email')
                    <span class="profile-edit-invalid">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="profile-edit-form-group">
                <label for="phone" class="profile-edit-form-label">
                    <i class="fas fa-phone"></i>
                    Phone
                </label>

                <input type="text" name="phone" id="phone"
                    class="form-control profile-edit-form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">

                @error('phone')
                    <span class="profile-edit-invalid">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="profile-edit-form-group">
                <label for="phone_2" class="profile-edit-form-label">
                    <i class="fas fa-phone-alt"></i>
                    Secondary Phone
                </label>

                <input type="text" name="phone_2" id="phone_2"
                    class="form-control profile-edit-form-control @error('phone_2') is-invalid @enderror"
                    value="{{ old('phone_2', $user->phone_2) }}" placeholder="Enter secondary phone">

                @error('phone_2')
                    <span class="profile-edit-invalid">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="profile-edit-form-group">
                <label for="profile_picture" class="profile-edit-form-label">
                    <i class="fas fa-camera"></i>
                    Profile Picture
                </label>

                <input type="file" name="profile_picture" id="profile_picture"
                    class="form-control profile-edit-form-control profile-edit-file @error('profile_picture') is-invalid @enderror"
                    accept="image/jpeg,image/png,image/jpg,image/gif">

                @error('profile_picture')
                    <span class="profile-edit-invalid">{{ $message }}</span>
                @enderror

                @if ($user->profile_picture)
                    <div class="profile-edit-current-image">
                        <img src="{{ asset($user->profile_picture) }}" alt="Current Profile Picture">
                        <span>Current profile picture</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
