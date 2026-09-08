<div class="service-image-section">
    <div class="service-section-title">
        <i class="fas fa-image"></i>
        Service Image
    </div>
    <p class="service-image-help">
        View the current service image or choose a new image to update it.
    </p>
    <div class="service-image-preview-grid">
        <div class="service-image-preview-card">
            <div class="service-image-preview-header">
                <div>
                    <strong>Current Image</strong>
                    <span>Currently saved service image</span>
                </div>
                <span class="service-image-label current">
                    <i class="fas fa-check-circle"></i>
                    Current
                </span>
            </div>
            <div class="service-image-preview-frame">
                <img src="{{ $service->image ? asset($service->image) : asset('uploads/images/default.jpg') }}"
                    alt="{{ $service->title }}"
                    id="serviceCurrentImage">
            </div>
        </div>
        <div class="service-image-preview-card">
            <div class="service-image-preview-header">
                <div>
                    <strong>New Image</strong>
                    <span>Preview before updating</span>
                </div>
                <span class="service-image-label new">
                    <i class="fas fa-camera"></i>
                    Preview
                </span>
            </div>
            <div class="service-image-preview-frame service-new-image-frame">
                <img src="{{ asset('uploads/images/default.jpg') }}"
                    id="servicePreviewImage"
                    alt="New Service Image">
            </div>
        </div>
    </div>
    <div class="service-image-upload">
        <input type="file"
            name="image"
            class="service-image-input"
            id="serviceImageInput"
            accept=".jpg,.jpeg,.png,.webp">
        <label for="serviceImageInput" class="service-image-upload-btn">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>Choose New Image</span>
        </label>
        <small id="serviceImageFileName" class="service-image-name">
            No new image selected
        </small>
        @error('image')
            <span class="service-field-error">{{ $message }}</span>
        @enderror
    </div>
</div>