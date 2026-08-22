<div class="service-schedule-pagination-wrapper">

    @if (!empty($schedulePages))

        @foreach ($schedulePages as $pageIndex => $pageSchedules)
            <div class="service-schedule-page {{ $pageIndex == 0 ? 'active' : '' }}" data-page="{{ $pageIndex }}">

                <div class="row">

                    @foreach ($pageSchedules as $date => $schedules)
                        @php
                            $carbonDate = \Carbon\Carbon::parse($date);

                            /*
                                            |--------------------------------------------------------------------------
                                            | Friday protection
                                            |--------------------------------------------------------------------------
                                            */

                            if ($carbonDate->dayOfWeek === \Carbon\Carbon::FRIDAY) {
                                continue;
                            }
                        @endphp

                        <div class="col-md-4 mb-3">

                            <div class="service-date-card-wrapper">

                                {{-- DATE HEADER --}}
                                <div class="service-date-header">

                                    <h5>
                                        {{ $carbonDate->format('l') }}
                                    </h5>

                                    <span>
                                        {{ $carbonDate->format('d M Y') }}
                                    </span>

                                </div>


                                {{-- TIME SLOTS --}}
                                <div class="service-time-slot-container">

                                    @foreach ($schedules as $schedule)
                                        @php
                                            $slotDate = \Carbon\Carbon::parse($schedule->date)->format('Y-m-d');

                                            $slotTime = \Carbon\Carbon::parse($schedule->time)->format('H:i:s');

                                            $isOccupied = (bool) $schedule->is_booked;

                                            /*
                                                            |--------------------------------------------------------------------------
                                                            | If previous booking attempt failed because slot
                                                            | was already booked, show it as occupied.
                                                            |--------------------------------------------------------------------------
                                                            */

                                            if (
                                                old('appointment_date') === $slotDate &&
                                                old('appointment_time') === $slotTime &&
                                                $errors->has('appointment_time')
                                            ) {
                                                $isOccupied = true;
                                            }

                                            /*
                                                            |--------------------------------------------------------------------------
                                                            | Selected old slot
                                                            |--------------------------------------------------------------------------
                                                            */

                                            $isSelected =
                                                !$isOccupied &&
                                                old('appointment_date') === $slotDate &&
                                                old('appointment_time') === $slotTime;
                                        @endphp


                                        <div class="service-date-card
                                                                {{ $isOccupied ? 'occupied' : '' }}
                                                                {{ $isSelected ? 'active' : '' }}"
                                            data-date="{{ $slotDate }}" data-time="{{ $slotTime }}"
                                            data-occupied="{{ $isOccupied ? 'true' : 'false' }}"
                                            aria-disabled="{{ $isOccupied ? 'true' : 'false' }}">

                                            <i
                                                class="fas {{ $isOccupied ? 'fa-times-circle text-danger' : 'fa-clock' }}"></i>

                                            @if ($isOccupied)
                                                <span class="slot-booked-text">
                                                    Booked
                                                </span>
                                            @else
                                                <span>
                                                    {{ \Carbon\Carbon::parse($slotTime)->format('h:i A') }}
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


        {{-- ==================================================
                            PAGINATION
                        =================================================== --}}

        @if (count($schedulePages) > 1)
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
        <div class="alert alert-info">
            No appointment schedules are currently available.
        </div>

    @endif

</div>
