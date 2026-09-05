<div class="modal fade" id="systemUserFilterModal" tabindex="-1" aria-labelledby="systemUserFilterModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content system-user-filter-modal">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title font-weight-bold" id="systemUserFilterModalLabel">
                        <i class="fas fa-filter mr-2"></i>
                        Filter Users
                    </h5>

                    <small class="text-muted">
                        Select a role to filter system users.
                    </small>
                </div>

                <button type="button" class="close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <div class="system-user-filter-group">
                    <label for="systemUserRoleFilter">
                        User Role
                    </label>

                    <select id="systemUserRoleFilter" class="form-control">
                        <option value="">All Users </option>
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option value="user">Patient User</option>
                    </select>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-light" id="clearSystemUserFilter">
                    <i class="fas fa-times mr-1"></i>
                    Clear
                </button>

                <button type="button" class="btn btn-primary" id="applySystemUserFilter">
                    <i class="fas fa-check mr-1"></i>
                    Apply Filter
                </button>
            </div>
        </div>
    </div>
</div>
