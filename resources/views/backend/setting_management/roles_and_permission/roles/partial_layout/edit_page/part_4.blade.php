<div class="card-body p-4">

    <div class="permission-main-scroll">

        @foreach ($groupedPermissions as $group => $groupPermissions)
            <div class="mb-4">

                {{-- GROUP HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                    <div>
                        <h5 class="fw-bold text-uppercase text-primary mb-1">
                            {{ ucfirst($group) }}
                        </h5>

                        <small class="text-muted">
                            Manage {{ ucfirst($group) }} related permissions.
                        </small>
                    </div>

                    <div class="d-flex gap-2">

                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 select-all-btn"
                            data-group="{{ $group }}">

                            <i class="fas fa-check me-1"></i>
                            Select All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 unselect-all-btn"
                            data-group="{{ $group }}">

                            <i class="fas fa-times me-1"></i>
                            Unselect All
                        </button>

                    </div>

                </div>

                {{-- PERMISSIONS --}}
                <div class="row">

                    @foreach ($groupPermissions as $permission)
                        <div class="col-xl-4 col-lg-6 mb-3">

                            <div class="permission-box p-3 rounded-4 border bg-light shadow-sm h-100">

                                <div class="form-check d-flex align-items-center">

                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="form-check-input me-3 perm-all perm-{{ $group }}"
                                        id="perm_{{ $permission->id }}"
                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>

                                    <label class="form-check-label fw-semibold text-dark"
                                        for="perm_{{ $permission->id }}">

                                        {{ $permission->name }}
                                    </label>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                <hr>

            </div>
        @endforeach

    </div>

</div>
