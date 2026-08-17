   <div class="row">
       <div class="col-md-6">
           <div class="form-group">
               <label>Consultation Fee</label>

               <input type="number" name="consultation_fee" value="{{ $doctor->consultation_fee }}"
                   class="form-control @error('consultation_fee') is-invalid @enderror">
               @error('consultation_fee')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>
       </div>

       <div class="col-md-6">
           <div class="form-group">
               <label>Availability</label>
               <select name="availability" class="form-control">
                   <option value="Available" {{ $doctor->availability == 'Available' ? 'selected' : '' }}>
                       Available
                   </option>
                   <option value="Unavailable" {{ $doctor->availability == 'Unavailable' ? 'selected' : '' }}>
                       Unavailable
                   </option>
               </select>
           </div>
       </div>
   </div>
