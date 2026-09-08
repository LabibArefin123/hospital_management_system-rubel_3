<div class="card service-schedule-form-card">
    <form action="{{ route('service-schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="service-schedule-form-group">
                        <label class="service-schedule-label">Select Service</label>
                        <select name="service_id" id="serviceSelect"
                            class="form-control service-schedule-control @error('service_id') is-invalid @enderror">
                            <option value="">Choose Service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    data-image="{{ asset($service->image ? $service->image : 'uploads/images/default.jpg') }}"
                                    data-title="{{ $service->title }}" data-price="{{ $service->price }}"
                                    data-description="{{ $service->description }}"
                                    {{ old('service_id', $schedule->service_id) == $service->id ? 'selected' : '' }}>
                                    {{ $service->title }}</option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <span class="service-schedule-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-schedule-form-group">
                        <label class="service-schedule-label">Date</label>
                        <input type="date" name="date"
                            class="form-control service-schedule-control @error('date') is-invalid @enderror"
                            value="{{ old('date', $schedule->date ? $schedule->date->format('Y-m-d') : '') }}">
                        @error('date')
                            <span class="service-schedule-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-schedule-form-group">
                        <label class="service-schedule-label">Time</label>
                        <input type="time" name="time"
                            class="form-control service-schedule-control @error('time') is-invalid @enderror"
                            value="{{ old('time', $schedule->time ? \Carbon\Carbon::parse($schedule->time)->format('H:i') : '') }}">
                        @error('time')
                            <span class="service-schedule-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="service-schedule-form-group service-schedule-status-group">
                <label class="service-schedule-label">Status</label>
                <select name="is_booked"
                    class="form-control service-schedule-control @error('is_booked') is-invalid @enderror">
                    <option value="0" {{ old('is_booked', $schedule->is_booked ? '1' : '0') == '0' ? 'selected' : '' }}>
                        Available</option>
                    <option value="1" {{ old('is_booked', $schedule->is_booked ? '1' : '0') == '1' ? 'selected' : '' }}>
                        Booked</option>
                </select>
                @error('is_booked')
                    <span class="service-schedule-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="service-schedule-card-footer">
            <button type="submit" class="service-schedule-submit-btn"><i class="fas fa-save"></i><span>Update
                    Schedule</span></button>
        </div>
    </form>
</div>
