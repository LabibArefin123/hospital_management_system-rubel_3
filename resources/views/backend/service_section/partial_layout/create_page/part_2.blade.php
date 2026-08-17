 <div class="form-group">

     <div class="d-flex justify-content-between align-items-center mb-2">

         <label class="mb-0">

             Instructions

         </label>

         <button type="button" id="addInstructionBtn" class="btn btn-success btn-sm">

             <i class="fas fa-plus"></i>

         </button>

     </div>

     <div id="instructionWrapper">

         @if (old('instructions'))

             @foreach (old('instructions') as $instruction)
                 <div class="instruction-item mb-2">

                     <div class="input-group">

                         <input type="text" name="instructions[]" value="{{ $instruction }}" class="form-control">

                         <div class="input-group-append">

                             <button type="button" class="btn btn-danger removeInstructionBtn">

                                 <i class="fas fa-minus"></i>

                             </button>

                         </div>

                     </div>

                 </div>
             @endforeach
         @else
             <div class="instruction-item mb-2">

                 <div class="input-group">

                     <input type="text" name="instructions[]" class="form-control">

                     <div class="input-group-append">

                         <button type="button" class="btn btn-danger removeInstructionBtn">

                             <i class="fas fa-minus"></i>

                         </button>

                     </div>

                 </div>

             </div>

         @endif

     </div>

 </div>
