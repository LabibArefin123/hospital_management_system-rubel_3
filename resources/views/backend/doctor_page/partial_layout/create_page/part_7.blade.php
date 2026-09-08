 <div class="doctor-image-section">

     <div class="doctor-section-title">
         <i class="fas fa-image"></i>
         Doctor Image
     </div>

     <p class="doctor-image-help">
         Upload a professional doctor image. The preview will appear instantly.
     </p>

     <div class="doctor-image-preview-grid">

         {{-- This is for default image --}}
         <div class="doctor-image-preview-card">
             <div class="doctor-image-preview-header">
                 <div>
                     <strong>Default Image</strong>
                     <span>Current placeholder</span>
                 </div>

                 <span class="doctor-image-label default">
                     <i class="fas fa-image"></i>
                     Default
                 </span>
             </div>

             <div class="doctor-image-preview-frame">
                 <img src="{{ asset('uploads/images/default.jpg') }}" alt="Default Doctor Image">
             </div>
         </div>

         {{-- This is for new image preview --}}
         <div class="doctor-image-preview-card">
             <div class="doctor-image-preview-header">
                 <div>
                     <strong>New Image</strong>
                     <span>Uploaded doctor image</span>
                 </div>

                 <span class="doctor-image-label new">
                     <i class="fas fa-camera"></i>
                     Preview
                 </span>
             </div>

             <div class="doctor-image-preview-frame doctor-new-image-frame">
                 <img src="{{ asset('uploads/images/default.jpg') }}" id="doctorImagePreview" alt="New Doctor Image">
             </div>
         </div>

     </div>

     {{-- This is for image upload --}}
     <div class="doctor-image-upload">
         <input type="file" name="image" id="doctorImageInput" class="doctor-image-input" accept="image/*">

         <label for="doctorImageInput" class="doctor-image-upload-btn">
             <i class="fas fa-cloud-upload-alt"></i>
             <span>Choose Doctor Image</span>
         </label>

         <small id="doctorImageName" class="doctor-image-name">
             No image selected
         </small>

         @error('image')
             <span class="doctor-field-error">{{ $message }}</span>
         @enderror
     </div>

 </div>
