 <div class="modal fade" id="replaceImageModal" tabindex="-1">

     <div class="modal-dialog modal-lg modal-dialog-centered">

         <div class="modal-content">

             <div class="modal-header">

                 <h5 class="modal-title">
                     Replace Image Confirmation
                 </h5>

                 <button type="button" class="close" data-dismiss="modal">
                     <span>&times;</span>
                 </button>

             </div>

             <div class="modal-body">

                 <div class="row">

                     {{-- ORIGINAL --}}
                     <div class="col-md-6 text-center">

                         <h6>Current Image</h6>

                         <img id="oldImagePreview" class="img-fluid rounded border" style="max-height:250px;">

                     </div>

                     {{-- NEW --}}
                     <div class="col-md-6 text-center">

                         <h6>New Image</h6>

                         <img id="newImagePreview" class="img-fluid rounded border" style="max-height:250px;">

                     </div>

                 </div>

             </div>

             <div class="modal-footer">

                 <button class="btn btn-success" id="confirmReplaceBtn">
                     Confirm Replace
                 </button>

                 <button class="btn btn-secondary" data-dismiss="modal">
                     Cancel
                 </button>

             </div>

         </div>

     </div>

 </div>
