<div class="doctor-form-section">

    <div class="doctor-section-title">
        <i class="fas fa-file-medical"></i>
        About Doctor
    </div>

    <div class="form-group">
        <label>Doctor Profile</label>

        <textarea name="about" rows="5" class="form-control" placeholder="Write a short professional profile...">{{ old('about', $doctor->about) }}</textarea>
    </div>

</div>
