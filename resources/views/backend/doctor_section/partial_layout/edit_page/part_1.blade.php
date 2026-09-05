<div class="doctor-image-section">
    <div class="doctor-section-title">
        <i class="fas fa-image"></i>
        Doctor Image
    </div>

    <p class="doctor-image-help">
        View the current image or choose a new professional image for this doctor.
    </p>

    <div class="doctor-image-preview-grid">

        {{-- This is for current doctor image --}}
        <div class="doctor-image-preview-card">

            <div class="doctor-image-preview-header">
                <div>
                    <strong>Current Image</strong>
                    <span>Currently saved doctor image</span>
                </div>

                <span class="doctor-image-label current">
                    <i class="fas fa-check-circle"></i>
                    Current
                </span>
            </div>

            <div class="doctor-image-preview-frame">

                <img src="{{ $doctor->image ? asset($doctor->image) : asset('uploads/images/default.jpg') }}"
                    alt="{{ $doctor->name }}" id="doctorCurrentImage">

            </div>

        </div>

        {{-- This is for new doctor image --}}
        <div class="doctor-image-preview-card">

            <div class="doctor-image-preview-header">
                <div>
                    <strong>New Image</strong>
                    <span>Preview before updating</span>
                </div>

                <span class="doctor-image-label new">
                    <i class="fas fa-camera"></i>
                    Preview
                </span>
            </div>

            <div class="doctor-image-preview-frame doctor-new-image-frame">

                <img src="{{ asset('uploads/images/default.jpg') }}" id="doctorPreviewImage" alt="New Doctor Image">

            </div>

        </div>

    </div>

    {{-- This is for image upload --}}
    <div class="doctor-image-upload">

        <input type="file" name="image" class="doctor-image-input" id="doctorImageInput" accept="image/*">

        <label for="doctorImageInput" class="doctor-image-upload-btn">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Choose New Image</span>
        </label>

        <small id="imageFileName" class="doctor-image-name">
            No new image selected
        </small>

        @error('image')
            <span class="doctor-field-error">{{ $message }}</span>
        @enderror

    </div>

</div>

