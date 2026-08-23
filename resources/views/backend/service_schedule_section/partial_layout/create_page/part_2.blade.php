<div class="card">
    <form action="{{ route('service-schedules.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Select Service</label>
                        <select name="service_id" id="serviceSelect"
                            class="form-control @error('service_id') is-invalid @enderror">
                            <option value="">Choose Service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    data-image="{{ asset($service->image ? $service->image : 'uploads/images/default.jpg') }}"
                                    data-title="{{ $service->title }}" data-price="{{ $service->price }}"
                                    data-description="{{ $service->description }}"
                                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date') }}">
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Time</label>
                        <input type="time" name="time" class="form-control @error('time') is-invalid @enderror"
                            value="{{ old('time') }}">
                        @error('time')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="is_booked" class="form-control @error('is_booked') is-invalid @enderror">
                    <option value="0" {{ old('is_booked', '0') == '0' ? 'selected' : '' }}>Available</option>
                    <option value="1" {{ old('is_booked') == '1' ? 'selected' : '' }}>Booked</option>
                </select>
                @error('is_booked')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer bg-white text-right">
            <button type="submit" class="btn btn-primary px-5">
                <i class="fas fa-save"></i>
                Save Schedule
            </button>
        </div>
    </form>
</div>
