<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Consultation Fee</label>
            <input type="number" step="0.01" name="consultation_fee"
                class="form-control @error('consultation_fee') is-invalid @enderror" value="{{ old('consultation_fee') }}"
                placeholder="1000">
            @error('consultation_fee')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Availability</label>
            <select name="availability" class="form-control @error('availability') is-invalid @enderror">
                <option value="Available" {{ old('availability', 'Available') == 'Available' ? 'selected' : '' }}>
                    Available</option>
                <option value="Unavailable" {{ old('availability') == 'Unavailable' ? 'selected' : '' }}>Unavailable
                </option>
            </select>
            @error('availability')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
