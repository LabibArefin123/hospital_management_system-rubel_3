<div class="schedule-pagination-wrapper">
    @foreach ($schedulePages as $pageIndex => $pageSchedules)
        <div class="schedule-page {{ $pageIndex == 0 ? 'active' : '' }}" data-page="{{ $pageIndex }}">
            <div class="row">
                @foreach ($pageSchedules as $scheduleDate)
                    <div class="col-md-4 mb-3">
                        <div class="date-card-wrapper">
                            {{-- DATE HEADER --}}
                            <div class="date-header">
                                <h5>{{ $scheduleDate['day'] }}</h5>
                                <span>{{ $scheduleDate['formatted_date'] }}</span>
                            </div>

                            {{-- TIME SLOTS --}}
                            <div class="time-slot-container">
                                @foreach ($scheduleDate['schedules'] as $schedule)
                                    <div class="date-card {{ $schedule['is_occupied'] ? 'occupied' : '' }}"
                                        data-date="{{ $schedule['date'] }}" data-time="{{ $schedule['time'] }}"
                                        data-occupied="{{ $schedule['is_occupied'] ? 'true' : 'false' }}"
                                        aria-disabled="{{ $schedule['is_occupied'] ? 'true' : 'false' }}">
                                        <i
                                            class="fas {{ $schedule['is_occupied'] ? 'fa-times-circle' : 'fa-clock' }}"></i>
                                        @if ($schedule['is_occupied'])
                                            <span>Booked</span>
                                        @else
                                            {{ $schedule['formatted_time'] }}
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

    {{--  PAGINATION --}}
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
