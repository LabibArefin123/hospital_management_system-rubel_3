 <div class="profile-edit-section">
     <div class="profile-image-edit-section">

         <div class="profile-image-edit-heading">
             <div class="profile-image-edit-icon">
                 <i class="fas fa-camera"></i>
             </div>

             <div>
                 <h5>Profile Picture</h5>
                 <small>Update your profile picture</small>
             </div>
         </div>

         <div class="profile-image-edit-content">

             {{-- CURRENT IMAGE --}}
             <div class="profile-image-current">

                 <div class="profile-image-label">
                     Current Picture
                 </div>

                 <div class="profile-image-current-wrapper">
                     <img src="{{ $profileImage }}" alt="{{ $user->name }}" class="profile-image-current-preview">
                 </div>

                 <small class="profile-image-current-name">
                     {{ $user->name }}
                 </small>

             </div>


             {{-- UPLOAD + PREVIEW --}}
             <div class="profile-image-upload-area">

                 <div class="profile-image-label">
                     New Picture Preview
                 </div>

                 <div class="profile-image-preview-wrapper">

                     <div class="profile-image-preview-empty" id="profileImagePreviewEmpty">
                         <i class="fas fa-image"></i>
                         <span>Image preview</span>
                     </div>

                     <img src="" alt="Profile image preview" class="profile-image-preview"
                         id="profileImagePreview">
                 </div>

                 <div class="profile-image-upload">

                     <label for="profile_picture" class="profile-image-upload-label">
                         <i class="fas fa-upload"></i>
                         Choose Profile Picture
                     </label>

                     <input type="file" name="profile_picture" id="profile_picture" class="profile-image-file-input"
                         accept="image/jpeg,image/png,image/jpg,image/webp">

                     <small class="profile-image-help">
                         JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
                     </small>

                     @error('profile_picture')
                         <span class="profile-edit-invalid">
                             {{ $message }}
                         </span>
                     @enderror

                 </div>

             </div>

         </div>

     </div>
 </div>
