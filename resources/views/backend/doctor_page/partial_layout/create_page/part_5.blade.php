<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Doctor Email <span class="text-danger">**</span></label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Doctor Username <span class="text-danger">**</span></label>
            <input type="text" name="username" class="form-control" placeholder="Enter username"
                value="{{ old('username') }}">
            @error('username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control">
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                    <i class="fa fa-eye"></i>
                </button>
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
