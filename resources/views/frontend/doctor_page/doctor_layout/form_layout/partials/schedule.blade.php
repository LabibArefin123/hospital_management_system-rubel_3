<div class="schedule-pagination-wrapper">
    @foreach ($schedulePages as $pageIndex => $pageSchedules)
        <div class="schedule-page {{ $pageIndex == 0 ? 'active' : '' }}" data-page="{{ $pageIndex }}">
            <div class="row">
                @foreach ($pageSchedules as $date => $schedules)
                    <div class="col-md-4 mb-3">
                        <div class="date-card-wrapper">
                            {{-- Date Header --}}
                            <div class="date-header">
                                <h5>{{ \Carbon\Carbon::parse($date)->format('l') }}</h5>
                                <span>{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</span>
                            </div>

                            {{-- Time Slots --}}
                            <div class="time-slot-container">
                                @foreach ($schedules as $schedule)
                                    @php
                                        $slotDate = \Carbon\Carbon::parse($schedule->date)->format('Y-m-d');
                                        $slotTime = \Carbon\Carbon::parse($schedule->time)->format('H:i');

                                        $slotKey = $slotDate . '|' . $slotTime;

                                        $isOccupied = isset($bookedSlots[$slotKey]);

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Keep selected slot occupied after validation error
                                        |--------------------------------------------------------------------------
                                        */

                                        if (
                                            old('appointment_date') === $slotDate &&
                                            old('appointment_time') === $slotTime &&
                                            $errors->has('appointment_time')
                                        ) {
                                            $isOccupied = true;
                                        }
                                    @endphp

                                    <div class="date-card {{ $isOccupied ? 'occupied' : '' }}"
                                        data-date="{{ $slotDate }}" data-time="{{ $slotTime }}"
                                        data-occupied="{{ $isOccupied ? 'true' : 'false' }}"
                                        aria-disabled="{{ $isOccupied ? 'true' : 'false' }}">

                                        <i class="fas {{ $isOccupied ? 'fa-times-circle' : 'fa-clock' }}"></i>

                                        @if ($isOccupied)
                                            <span>Booked</span>
                                        @else
                                            {{ \Carbon\Carbon::parse($slotTime)->format('h:i A') }}
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- PAGINATION --}}
    @if ($schedulePages->count() > 1)
        <div class="schedule-pagination-controls">
            <button type="button" id="prevSchedule">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button type="button" id="nextSchedule">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    @endif
</div>
