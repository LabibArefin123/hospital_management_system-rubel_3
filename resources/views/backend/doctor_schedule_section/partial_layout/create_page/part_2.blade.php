<div class="card doctor-schedule-form-card">
    <form action="{{ route('doctor-schedules.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="doctor-schedule-form-group">
                        <label class="doctor-schedule-label">Select Doctor</label>
                        <select name="doctor_id" id="doctorSelect"
                            class="form-control doctor-schedule-control @error('doctor_id') is-invalid @enderror">
                            <option value="">Choose Doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    data-image="{{ asset($doctor->image ? $doctor->image : 'uploads/images/default.jpg') }}"
                                    data-name="{{ $doctor->name }}" data-speciality="{{ $doctor->speciality }}"
                                    data-email="{{ $doctor->user->email ?? 'No Email' }}"
                                    data-username="{{ $doctor->user->username ?? 'No Username' }}"
                                    data-qualification="{{ $doctor->qualification ?? 'N/A' }}"
                                    data-experience="{{ $doctor->experience_years ?? 0 }}"
                                    data-success-rate="{{ $doctor->success_rate ?? 0 }}"
                                    data-total-patients="{{ $doctor->total_patients ?? 0 }}"
                                    data-location="{{ $doctor->location ?? 'N/A' }}"
                                    data-consultation-fee="{{ $doctor->consultation_fee ?? 0 }}"
                                    data-availability="{{ $doctor->availability ?? 'N/A' }}"
                                    data-about="{{ $doctor->about ?? 'No information available.' }}"
                                    {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}
                                    ({{ $doctor->speciality }})</option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <span class="doctor-schedule-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="doctor-schedule-form-group">
                        <label class="doctor-schedule-label">Date</label>
                        <input type="date" name="date"
                            class="form-control doctor-schedule-control @error('date') is-invalid @enderror"
                            value="{{ old('date') }}">
                        @error('date')
                            <span class="doctor-schedule-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="doctor-schedule-form-group">
                        <label class="doctor-schedule-label">Time</label>
                        <input type="time" name="time"
                            class="form-control doctor-schedule-control @error('time') is-invalid @enderror"
                            value="{{ old('time') }}">
                        @error('time')
                            <span class="doctor-schedule-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="doctor-schedule-form-group doctor-schedule-status-group">
                <label class="doctor-schedule-label">Status</label>
                <select name="is_booked"
                    class="form-control doctor-schedule-control @error('is_booked') is-invalid @enderror">
                    <option value="0" {{ old('is_booked', '0') == '0' ? 'selected' : '' }}>Available</option>
                    <option value="1" {{ old('is_booked') == '1' ? 'selected' : '' }}>Booked</option>
                </select>
                @error('is_booked')
                    <span class="doctor-schedule-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="doctor-schedule-card-footer">
            <button type="submit" class="doctor-schedule-submit-btn"><i class="fas fa-save"></i><span>Save
                    Schedule</span></button>
        </div>
    </form>
</div>
