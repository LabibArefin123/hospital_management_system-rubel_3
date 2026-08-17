 <div class="row">
     <div class="col-md-4">
         <div class="form-group">
             <label>Success Rate</label>
             <input type="number" name="success_rate" value="{{ $doctor->success_rate }}"
                 class="form-control @error('success_rate') is-invalid @enderror">
             @error('success_rate')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
     </div>

     <div class="col-md-4">
         <div class="form-group">
             <label>Experience</label>
             <input type="number" name="experience_years" value="{{ $doctor->experience_years }}"
                 class="form-control @error('experience_years') is-invalid @enderror">
             @error('experience_years')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
     </div>

     <div class="col-md-4">
         <div class="form-group">
             <label>Total Patients</label>
             <input type="text" name="total_patients" value="{{ $doctor->total_patients }}"
                 class="form-control @error('total_patients') is-invalid @enderror">
             @error('total_patients')
                 <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
     </div>

 </div>
