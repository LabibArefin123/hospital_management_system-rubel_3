<div class="card border-0 shadow-lg rounded-4 mb-4">

    <div class="card-header bg-white border-0 pt-4 px-4">

        <h4 class="fw-bold text-primary mb-1">
            Role Information
        </h4>

        <p class="text-muted mb-0">
            Enter role details and configure permissions.
        </p>

    </div>

    <div class="card-body px-4 pb-4">

        <div class="mb-3">

            <label class="form-label fw-semibold">
                Role Name
            </label>

            <input type="text" name="name"
                class="form-control form-control-lg rounded-3 shadow-sm @error('name') is-invalid @enderror"
                placeholder="Enter role name" value="{{ old('name') }}">

            @error('name')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

    </div>

</div>
