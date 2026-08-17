 <div class="row">
     <div class="col-md-4">
         <div class="form-group">
             <label>Success Rate (%)</label>
             <input type="number" name="success_rate" class="form-control @error('success_rate') is-invalid @enderror"
                 value="{{ old('success_rate') }}" placeholder="95">

             @error('success_rate')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
     </div>

     <div class="col-md-4">
         <div class="form-group">
             <label>Experience Years</label>
             <input type="number" name="experience_years"
                 class="form-control @error('experience_years') is-invalid @enderror"
                 value="{{ old('experience_years') }}" placeholder="5+ Years">

             @error('experience_years')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
     </div>

     <div class="col-md-4">
         <div class="form-group">
             <label>Total Patients</label>

             <input type="number" name="total_patients"
                 class="form-control @error('total_patients') is-invalid @enderror" value="{{ old('total_patients') }}"
                 placeholder=" ">

             @error('total_patients')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
     </div>
 </div>
