<div class="doctor-form-section">
    <div class="doctor-section-title">
        <i class="fas fa-file-medical"></i>
        About Doctor
    </div>

    <div class="form-group">
        <label for="about">Doctor Profile</label>

        <textarea name="about" id="about" rows="5" class="form-control"
            placeholder="Write a short professional profile about the doctor...">{{ old('about') }}</textarea>

        @error('about')
            <span class="doctor-field-error">{{ $message }}</span>
        @enderror
    </div>
</div>
