<div class="col-md-4 te<div class="text-center">
    @if ($doctor->image)
        <img src="{{ $doctor->image ? asset($doctor->image) : asset('uploads/images/default.jpg') }}"
            class="img-circle elevation-3 mb-3 doctor-preview-image" id="doctorPreviewImage" width="180" height="180"
            style="object-fit: cover;">
    @endif

    <div class="form-group">
        <label class="font-weight-bold">
            Update Image
        </label>

        <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="doctorImageInput" accept="image/*">
            <label class="custom-file-label">
                Choose Image
            </label>
        </div>
    </div>

    {{-- IMAGE INFORMATION --}}
    <div class="card shadow-sm mt-3">
        <div class="card-body text-left">
            <h6 class="font-weight-bold text-primary mb-3">
                <i class="fas fa-image"></i>
                Image Information
            </h6>

            <ul class="list-group">
                <li class="list-group-item">
                    <strong>File Name:</strong>
                    <span id="imageFileName">N/A</span>
                </li>

                <li class="list-group-item">
                    <strong>File Size:</strong>
                    <span id="imageFileSize">N/A</span>
                </li>

                <li class="list-group-item">
                    <strong>Dimensions:</strong>
                    <span id="imageDimensions">N/A</span>
                </li>

                <li class="list-group-item">
                    <strong>Format:</strong>
                    <span id="imageFormat">N/A</span>
                </li>

                <li class="list-group-item">
                    <strong>Shape:</strong>
                    <span id="imageShape">N/A</span>
                </li>
            </ul>
        </div>
    </div>
</div>
