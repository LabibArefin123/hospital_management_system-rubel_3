<div class="service-form-section">
    <div class="service-section-title">
        <i class="fas fa-info-circle"></i>
        Basic Information
    </div>
    <p class="service-section-help">
        Enter the basic details and pricing information for this service.
    </p>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="serviceTitle">Service Title <span class="text-danger">**</span></label>
            <input type="text" name="title" id="serviceTitle" value="{{ old('title') }}"
                class="form-control @error('title') is-invalid @enderror" placeholder="Enter service title">
            @error('title')
                <span class="service-field-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="servicePrice">Price <span class="text-danger">**</span></label>
            <input type="number" step="0.01" name="price" id="servicePrice" value="{{ old('price') }}"
                class="form-control @error('price') is-invalid @enderror" placeholder="Enter service price">
            @error('price')
                <span class="service-field-error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="serviceDescription">Description</label>
        <textarea name="description" id="serviceDescription" rows="4"
            class="form-control @error('description') is-invalid @enderror" placeholder="Enter service description">{{ old('description') }}</textarea>
        @error('description')
            <span class="service-field-error">{{ $message }}</span>
        @enderror
    </div>
</div>
