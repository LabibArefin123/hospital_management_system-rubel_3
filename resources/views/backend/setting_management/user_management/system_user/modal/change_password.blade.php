{{--  SYSTEM USER - CHANGE PASSWORD MODAL  --}}
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            {{--  MODAL HEADER  --}}
            <div class="modal-header bg-danger text-white border-0">
                <div>
                    <h5 class="modal-title mb-1" id="changePasswordModalLabel">
                        <i class="fas fa-key mr-2"></i>Change Password
                    </h5>
                    <small class="opacity-75">Update the user's account password</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            {{--  PASSWORD FORM  --}}
            <form method="POST" id="changePasswordForm">
                @csrf

                {{--  MODAL BODY  --}}
                <div class="modal-body p-4">

                    {{--  SELECTED USER  --}}
                    <div class="bg-light rounded p-3 mb-4">
                        <div class="d-flex align-items-center">

                            {{--  USER PROFILE PICTURE  --}}
                            <div class="mr-3" style="width:60px;height:60px;flex:0 0 50px;">
                                <img src="{{ asset('uploads/images/default.jpg') }}" id="modalUserPicture"
                                    alt="User" style="width:50px;height:50px;object-fit:cover;border-radius:50%;">
                            </div>

                            {{--  USER INFORMATION  --}}
                            <div class="overflow-hidden">
                                <div class="font-weight-bold text-dark" id="modalUserName">User Name</div>
                                <div class="small text-muted" id="modalUserRole"></div>
                                <div class="small text-muted text-truncate" id="modalUserEmail">user@email.com</div>
                            </div>

                        </div>
                    </div>

                    {{--  PASSWORD SECURITY  --}}
                    <div class="alert alert-warning d-flex align-items-start mb-4">
                        <i class="fas fa-shield-alt mr-2 mt-1"></i>
                        <div>
                            <strong>Password Security</strong>
                            <div class="small">Choose a strong password that is difficult to guess.</div>
                        </div>
                    </div>

                    {{--  NEW PASSWORD  --}}
                    <div class="form-group">
                        <label for="password" class="font-weight-bold">
                            <i class="fas fa-lock mr-1 text-danger"></i>
                            New Password
                        </label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter new password" autocomplete="new-password" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                    data-target="password" tabindex="-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{--  CONFIRM PASSWORD  --}}
                    <div class="form-group mb-0">
                        <label for="password_confirmation" class="font-weight-bold">
                            <i class="fas fa-check-circle mr-1 text-success"></i>
                            Confirm Password
                        </label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Confirm new password" autocomplete="new-password"
                                required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary toggle-password"
                                    data-target="password_confirmation" tabindex="-1">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                {{--  MODAL FOOTER  --}}
                <div class="modal-footer bg-light border-0 px-4 py-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-key mr-1"></i>
                        Update Password
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
