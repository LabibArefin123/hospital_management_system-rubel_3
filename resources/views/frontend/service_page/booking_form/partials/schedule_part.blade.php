<div class="service-schedule-pagination-wrapper">

    @if ($schedulePages->isNotEmpty())

        @foreach ($schedulePages as $pageIndex => $pageSchedules)
            <div class="service-schedule-page {{ $pageIndex === 0 ? 'active' : '' }}" data-page="{{ $pageIndex }}">

                <div class="row">

                    @foreach ($pageSchedules as $scheduleDate)
                        <div class="col-md-4 mb-3">

                            <div class="service-date-card-wrapper">

                                {{-- DATE HEADER --}}
                                <div class="service-date-header">

                                    <h5>
                                        {{ $scheduleDate['day_name'] }}
                                    </h5>

                                    <span>
                                        {{ $scheduleDate['formatted_date'] }}
                                    </span>

                                </div>


                                {{-- TIME SLOTS --}}
                                <div class="service-time-slot-container">

                                    @foreach ($scheduleDate['schedules'] as $schedule)
                                        <div class="service-date-card
                                                {{ $schedule['is_occupied'] ? 'occupied' : '' }}
                                                {{ $schedule['is_selected'] ? 'active' : '' }}"
                                            data-date="{{ $schedule['date'] }}" data-time="{{ $schedule['time'] }}"
                                            data-schedule-id="{{ $schedule['id'] }}"
                                            data-occupied="{{ $schedule['is_occupied'] ? 'true' : 'false' }}"
                                            aria-disabled="{{ $schedule['is_occupied'] ? 'true' : 'false' }}">

                                            @if ($schedule['is_occupied'])
                                                <i class="fas fa-times-circle text-danger"></i>

                                                <span class="slot-booked-text">
                                                    Booked
                                                </span>
                                            @else
                                                <i class="fas fa-clock"></i>

                                                <span>
                                                    {{ $schedule['formatted_time'] }}
                                                </span>
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
            <div class="service-schedule-pagination-controls">

                <button type="button" id="prevServiceSchedule" disabled aria-label="Previous schedule page">
                    <i class="fas fa-chevron-left"></i>
                </button>


                <button type="button" id="nextServiceSchedule" aria-label="Next schedule page">
                    <i class="fas fa-chevron-right"></i>
                </button>

            </div>
        @endif
    @else
        <div class="alert alert-info mb-0">
            No appointment schedules are currently available.
        </div>

    @endif

</div>
