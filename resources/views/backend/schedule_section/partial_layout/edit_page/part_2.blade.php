 <div class="card shadow border-0">

     <form action="{{ route('doctor-schedules.update', $schedule->id) }}" method="POST">

         @csrf
         @method('PUT')

         <div class="card-body">

             <div class="row">

                 {{-- DOCTOR --}}
                 <div class="col-md-4">

                     <div class="form-group">

                         <label>Select Doctor</label>

                         <select name="doctor_id" id="doctorSelect"
                             class="form-control @error('doctor_id') is-invalid @enderror">

                             @foreach ($doctors as $doctor)
                                 <option value="{{ $doctor->id }}"
                                     data-image="{{ asset($doctor->image ? $doctor->image : 'uploads/images/default.jpg') }}"
                                     data-name="{{ $doctor->name }}" data-speciality="{{ $doctor->speciality }}"
                                     data-email="{{ $doctor->user->email ?? 'No Email' }}"
                                     data-username="{{ $doctor->user->username ?? 'No Username' }}"
                                     {{ old('doctor_id', $schedule->doctor_id) == $doctor->id ? 'selected' : '' }}>

                                     {{ $doctor->name }}

                                 </option>
                             @endforeach

                         </select>

                         @error('doctor_id')
                             <span class="text-danger">

                                 {{ $message }}

                             </span>
                         @enderror

                     </div>

                 </div>

                 {{-- DATE --}}
                 <div class="col-md-4">

                     <div class="form-group">

                         <label>Date</label>

                         <input type="date" name="date" value="{{ old('date', $schedule->date) }}"
                             class="form-control @error('date') is-invalid @enderror">

                         @error('date')
                             <span class="text-danger">

                                 {{ $message }}

                             </span>
                         @enderror

                     </div>

                 </div>

                 {{-- TIME --}}
                 <div class="col-md-4">

                     <div class="form-group">

                         <label>Time</label>

                         <input type="time" name="time" value="{{ old('time', $schedule->time) }}"
                             class="form-control @error('time') is-invalid @enderror">

                         @error('time')
                             <span class="text-danger">

                                 {{ $message }}

                             </span>
                         @enderror

                     </div>

                 </div>

             </div>

             {{-- STATUS --}}
             <div class="form-group">

                 <label>Status</label>

                 <select name="is_booked" class="form-control @error('is_booked') is-invalid @enderror">

                     <option value="0" {{ old('is_booked', $schedule->is_booked) == 0 ? 'selected' : '' }}>

                         Available

                     </option>

                     <option value="1" {{ old('is_booked', $schedule->is_booked) == 1 ? 'selected' : '' }}>

                         Booked

                     </option>

                 </select>

                 @error('is_booked')
                     <span class="text-danger">

                         {{ $message }}

                     </span>
                 @enderror

             </div>

         </div>

         <div class="card-footer bg-white text-right">

             <button type="submit" class="btn btn-warning px-5">

                 <i class="fas fa-save"></i>

                 Update Schedule

             </button>

         </div>

     </form>

 </div>
