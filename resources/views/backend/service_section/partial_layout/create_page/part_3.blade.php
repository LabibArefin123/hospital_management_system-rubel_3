 <div class="service-image-section">

     <div class="service-section-title">
         <i class="fas fa-image"></i>
         service Image
     </div>

     <p class="service-image-help">
         Upload a professional service image. The preview will appear instantly.
     </p>

     <div class="service-image-preview-grid">

         {{-- This is for default image --}}
         <div class="service-image-preview-card">
             <div class="service-image-preview-header">
                 <div>
                     <strong>Default Image</strong>
                     <span>Current placeholder</span>
                 </div>

                 <span class="service-image-label default">
                     <i class="fas fa-image"></i>
                     Default
                 </span>
             </div>

             <div class="service-image-preview-frame">
                 <img src="{{ asset('uploads/images/default.jpg') }}" alt="Default service Image">
             </div>
         </div>

         {{-- This is for new image preview --}}
         <div class="service-image-preview-card">
             <div class="service-image-preview-header">
                 <div>
                     <strong>New Image</strong>
                     <span>Uploaded service image</span>
                 </div>

                 <span class="service-image-label new">
                     <i class="fas fa-camera"></i>
                     Preview
                 </span>
             </div>

             <div class="service-image-preview-frame service-new-image-frame">
                 <img src="{{ asset('uploads/images/default.jpg') }}" id="serviceImagePreview" alt="New service Image">
             </div>
         </div>

     </div>

     {{-- This is for image upload --}}
     <div class="service-image-upload">
         <input type="file" name="image" id="serviceImageInput" class="service-image-input" accept="image/*">

         <label for="serviceImageInput" class="service-image-upload-btn">
             <i class="fas fa-cloud-upload-alt"></i>
             <span>Choose service Image</span>
         </label>

         <small id="serviceImageName" class="service-image-name">
             No image selected
         </small>

         @error('image')
             <span class="service-field-error">{{ $message }}</span>
         @enderror
     </div>

 </div>
