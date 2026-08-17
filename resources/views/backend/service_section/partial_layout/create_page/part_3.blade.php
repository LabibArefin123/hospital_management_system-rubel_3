<div class="form-group">

    <label class="font-weight-bold">

        Service Image

    </label>

    <br>

    <button type="button" class="btn btn-primary" id="openImageModal">

        <i class="fas fa-image mr-1"></i>

        Upload Image

    </button>

    {{-- REAL FILE INPUT --}}
    <input type="file" name="image" id="doctorImageInput" accept=".jpg,.jpeg,.png,.webp" class="d-none">

    @error('image')
        <div class="text-danger mt-2">

            {{ $message }}

        </div>
    @enderror

    {{-- FINAL PREVIEW --}}
    <div class="mt-3">

        <img id="finalPreviewImage" class="img-fluid rounded border d-none" style="max-height:250px;">

    </div>

</div>
