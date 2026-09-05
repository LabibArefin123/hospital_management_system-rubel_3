<div id="systemUserFilterSection" class="system-user-filter-section d-none">
    <div class="system-user-filter-content">
        <div class="system-user-filter-fields">
            <div class="system-user-filter-item system-user-search-field">
                <label for="systemUserSearch">
                    <i class="fas fa-search mr-1"></i>
                    Search Users
                </label>
                <div class="system-user-search-wrapper">
                    <input type="text" id="systemUserSearch" class="form-control"
                        placeholder="Search by name, email, phone or username...">
                    <button type="button" id="clearSystemUserSearch" class="system-user-search-clear d-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="system-user-filter-item system-user-role-field">
                <label for="systemUserRoleFilter">
                    <i class="fas fa-user-tag mr-1"></i>
                    User Role
                </label>
                <select id="systemUserRoleFilter" class="form-control">
                    <option value="">All Users</option>
                    <option value="admin">Admin</option>
                    <option value="doctor">Doctor</option>
                    <option value="user">Patient User</option>
                </select>
            </div>
        </div>
        <div class="system-user-filter-actions">
            <button type="button" class="btn btn-light" id="clearSystemUserFilter">
                <i class="fas fa-undo mr-1"></i>
                Clear
            </button>
            <button type="button" class="btn btn-primary" id="applySystemUserFilter">
                <i class="fas fa-filter mr-1"></i>
                Apply Filter
            </button>
        </div>
    </div>
</div>
