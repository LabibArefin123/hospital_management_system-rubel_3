<div class="role-info-card">
    <div class="role-card-header">
        <div class="role-card-icon">
            <i class="fas fa-user-tag"></i>
        </div>
        <div>
            <h4>Role Information</h4>
            <p>Enter the role name and configure access permissions.</p>
        </div>
    </div>

    <div class="role-card-body">
        <div class="role-field">
            <label for="roleName">Role Name</label>

            <div class="role-input-wrapper">
                <i class="fas fa-shield-alt"></i>

                <input type="text" id="roleName" name="name"
                    class="role-input @error('name') is-invalid @enderror" placeholder="Enter role name"
                    value="{{ old('name') }}">
            </div>

            @error('name')
                <span class="role-input-error">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
