<div class="permission-manager-body">
    <div class="permission-main-scroll">
        @foreach ($groupedPermissions as $group => $groupPermissions)
            <div class="permission-group">
                <div class="permission-group-header">
                    <div class="permission-group-title">
                        <h5>{{ ucfirst($group) }}</h5>
                        <p>Manage {{ ucfirst($group) }} related permissions.</p>
                    </div>

                    <div class="permission-group-actions">
                        <button type="button" class="permission-group-select select-all-btn"
                            data-group="{{ $group }}">
                            <i class="fas fa-check"></i>
                            <span>Select All</span>
                        </button>

                        <button type="button" class="permission-group-unselect unselect-all-btn"
                            data-group="{{ $group }}">
                            <i class="fas fa-times"></i>
                            <span>Unselect All</span>
                        </button>
                    </div>
                </div>

                <div class="row">
                    @foreach ($groupPermissions as $permission)
                        <div class="col-xl-4 col-lg-6 mb-3">
                            <div class="permission-box">
                                <div class="form-check d-flex align-items-center">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="form-check-input perm-all perm-{{ $group }}"
                                        id="perm_{{ $permission->id }}">

                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <hr class="permission-group-divider">
            </div>
        @endforeach
    </div>
</div>
