<div class="doctor-form-section">
    <div class="doctor-section-title">
        <i class="fas fa-graduation-cap"></i>
        Professional Information
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Qualification</label>
                <input type="text" name="qualification"
                    class="form-control @error('qualification') is-invalid @enderror" value="{{ old('qualification') }}"
                    placeholder="MBBS, FCPS">
                @error('qualification')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location') }}" placeholder="Dhaka Medical Center">
                @error('location')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
