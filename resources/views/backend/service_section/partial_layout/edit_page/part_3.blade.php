 <div class="row">
     {{-- CURRENT IMAGE CARD --}}
     <div class="col-md-6">
         <div class="card card-outline card-info shadow-sm h-100">
             <div class="card-header bg-info">
                 <h5 class="card-title text-white mb-0">
                     <i class="fas fa-image mr-2"></i>
                     Current Image
                 </h5>
             </div>

             <div class="card-body text-center">
                 @if ($service->image)
                     <img src="{{ asset($service->image) }}" id="currentServiceImage"
                         data-image-url="{{ asset($service->image) }}" class="img-fluid rounded border shadow-sm mb-3"
                         style="
                                                max-height:250px;
                                                object-fit:cover;
                                            ">
                     <div class="table-responsive">
                         <table class="table table-bordered table-sm">
                             <tbody>
                                 <tr>
                                     <th width="40%">
                                         File Name
                                     </th>

                                     <td id="currentImageName">
                                         Loading...
                                     </td>
                                 </tr>
                                 <tr>
                                     <th>
                                         File Size
                                     </th>

                                     <td id="currentImageSize">
                                         Loading...
                                     </td>
                                 </tr>
                                 <tr>
                                     <th>
                                         Image Type
                                     </th>
                                     <td id="currentImageType">
                                         Loading...
                                     </td>
                                 </tr>
                                 <tr>
                                     <th>
                                         Dimensions
                                     </th>

                                     <td id="currentImageDimension">
                                         Loading...
                                     </td>
                                 </tr>

                                 <tr>
                                     <th>
                                         Shape
                                     </th>
                                     <td id="currentImageShape">
                                         Loading...
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 @else
                     <div class="alert alert-warning mb-0">
                         No image available
                     </div>
                 @endif
             </div>
         </div>
     </div>

     {{-- CHANGE IMAGE CARD --}}
     <div class="col-md-6">
         <div class="card card-outline card-success shadow-sm h-100">
             <div class="card-header bg-success">
                 <h5 class="card-title text-white mb-0">
                     <i class="fas fa-upload mr-2"></i>
                     Replace Image
                 </h5>
             </div>

             <div class="card-body text-center">
                 <button type="button" class="btn btn-primary mb-3" id="openImageModal">
                     <i class="fas fa-image mr-1"></i>
                     Choose New Image
                 </button>

                 {{-- REAL FILE INPUT --}}
                 <input type="file" name="image" id="doctorImageInput" accept=".jpg,.jpeg,.png,.webp"
                     class="d-none">
                 @error('image')
                     <div class="text-danger mb-3">
                         {{ $message }}
                     </div>
                 @enderror
                 {{-- FINAL PREVIEW --}}
                 <img id="finalPreviewImage" class="img-fluid rounded border shadow-sm d-none mb-3"
                     style="
                                        max-height:250px;
                                        object-fit:cover;
                                    ">

                 {{-- NEW IMAGE INFO --}}
                 <div id="newImageInfoWrapper" class="table-responsive d-none">
                     <table class="table table-bordered table-sm">
                         <tbody>
                             <tr>
                                 <th width="40%">
                                     File Name
                                 </th>

                                 <td id="newImageName">
                                     -
                                 </td>
                             </tr>

                             <tr>
                                 <th>
                                     File Size
                                 </th>

                                 <td id="newImageSize">
                                     -
                                 </td>
                             </tr>

                             <tr>
                                 <th>
                                     Image Type
                                 </th>

                                 <td id="newImageType">
                                     -
                                 </td>
                             </tr>

                             <tr>
                                 <th>
                                     Dimensions
                                 </th>

                                 <td id="newImageDimension">
                                     -
                                 </td>
                             </tr>

                             <tr>
                                 <th>
                                     Shape
                                 </th>

                                 <td id="newImageShape">
                                     -
                                 </td>
                             </tr>

                         </tbody>

                     </table>

                 </div>

             </div>

         </div>

     </div>

 </div>
