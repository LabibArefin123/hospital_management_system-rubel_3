<div class="profile-edit-footer">
    <div class="profile-edit-footer-left">
        <i class="fas fa-shield-alt"></i>
        Your account information is securely protected.
    </div>

    <div class="profile-edit-actions">
        <a href="{{ route('system_users.user_profile_show') }}" class="btn btn-light profile-edit-cancel-btn">
            <i class="fas fa-times"></i>
            Cancel
        </a>

        <button type="submit" class="btn btn-primary profile-edit-save-btn">
            <i class="fas fa-save"></i>
            Update Profile
        </button>
    </div>
</div>
