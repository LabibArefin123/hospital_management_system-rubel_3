<div class="profile-edit-section">
    <div class="profile-password-section">
        <div class="profile-password-heading">
            <div class="profile-password-icon">
                <i class="fas fa-lock"></i>
            </div>

            <div>
                <h5>Change Password</h5>
                <small>Leave these fields empty if you do not want to change it</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="profile-edit-form-group mb-md-0">
                    <label for="current_password" class="profile-edit-form-label">
                        Current Password
                    </label>

                    <div class="profile-password-input">
                        <input type="password" name="current_password" id="current_password"
                            class="form-control profile-edit-form-control @error('current_password') is-invalid @enderror"
                            placeholder="Current password">

                        <button type="button" class="profile-password-toggle toggle-password"
                            data-target="current_password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    @error('current_password')
                        <span class="profile-edit-invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="profile-edit-form-group mb-md-0">
                    <label for="new_password" class="profile-edit-form-label">
                        New Password
                    </label>

                    <div class="profile-password-input">
                        <input type="password" name="new_password" id="new_password"
                            class="form-control profile-edit-form-control @error('new_password') is-invalid @enderror"
                            placeholder="New password">

                        <button type="button" class="profile-password-toggle toggle-password"
                            data-target="new_password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    @error('new_password')
                        <span class="profile-edit-invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="profile-edit-form-group mb-0">
                    <label for="confirm_password" class="profile-edit-form-label">
                        Confirm Password
                    </label>

                    <div class="profile-password-input">
                        <input type="password" name="confirm_password" id="confirm_password"
                            class="form-control profile-edit-form-control @error('confirm_password') is-invalid @enderror"
                            placeholder="Confirm password">

                        <button type="button" class="profile-password-toggle toggle-password"
                            data-target="confirm_password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    @error('confirm_password')
                        <span class="profile-edit-invalid">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="profile-password-note">
            <i class="fas fa-info-circle"></i>
            <span>
                Your current password is required whenever you want to change
                your password.
            </span>
        </div>
    </div>
</div>
