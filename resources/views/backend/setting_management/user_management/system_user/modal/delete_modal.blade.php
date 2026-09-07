<div class="modal fade system-delete-modal" id="systemDeleteModal" tabindex="-1" aria-labelledby="systemDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content system-delete-modal-content">
            <div class="system-delete-modal-header">
                <div class="system-delete-modal-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <button type="button" class="system-delete-modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="system-delete-modal-body">
                <h4 id="systemDeleteModalLabel">Delete User?</h4>
                <p class="system-delete-modal-message">Are you sure you want to delete this user?</p>
                <div class="system-delete-warning">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <strong>This action cannot be undone.</strong>
                        <span>All account-related information may be permanently removed from the system.</span>
                    </div>
                </div>
                <div class="system-delete-account-info">
                    <div class="system-delete-account-avatar">
                        <img id="systemDeleteUserPicture" src="{{ asset('uploads/images/default.jpg') }}"
                            alt="User">
                    </div>
                    <div class="system-delete-account-details">
                        <strong id="systemDeleteUserName">User Name</strong>
                        <span id="systemDeleteUserEmail">Email</span>
                        <small id="systemDeleteUserRole">Role</small>
                    </div>
                </div>
            </div>
            <div class="system-delete-modal-footer">
                <button type="button" class="system-delete-btn system-delete-btn-cancel" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <form action="" method="POST" id="systemDeleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="system-delete-btn system-delete-btn-confirm" id="systemDeleteConfirm">
                        <i class="fas fa-trash-alt"></i>
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
