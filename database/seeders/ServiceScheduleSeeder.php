<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ServiceScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Bangladesh Timezone
        |--------------------------------------------------------------------------
        */
        $timezone = 'Asia/Dhaka';

        /*
        |--------------------------------------------------------------------------
        | Get all services
        |--------------------------------------------------------------------------
        */
        $services = Service::query()->get();

        if ($services->isEmpty()) {
            $this->command->warn('No services found. ServiceScheduleSeeder skipped.');

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Schedule generation settings
        |--------------------------------------------------------------------------
        |
        | Each service gets between 10 and 15 slots.
        |
        | Available time:
        | 09:00 AM - 09:00 PM
        |
        | Friday is always excluded.
        |
        |--------------------------------------------------------------------------
        */
        $minimumSlots = 10;
        $maximumSlots = 15;

        /*
        |--------------------------------------------------------------------------
        | Available appointment times
        |--------------------------------------------------------------------------
        |
        | 30-minute intervals.
        |
        |--------------------------------------------------------------------------
        */
        $availableTimes = [];

        $startTime = Carbon::createFromTime(9, 0, 0, $timezone);
        $endTime = Carbon::createFromTime(21, 0, 0, $timezone);

        while ($startTime->lt($endTime)) {
            $availableTimes[] = $startTime->format('H:i:s');

            $startTime->addMinutes(30);
        }

        /*
        |--------------------------------------------------------------------------
        | Generate schedules
        |--------------------------------------------------------------------------
        */
        foreach ($services as $service) {

            /*
            |--------------------------------------------------------------------------
            | Random number of schedules for this service
            |--------------------------------------------------------------------------
            */
            $slotCount = rand($minimumSlots, $maximumSlots);

            /*
            |--------------------------------------------------------------------------
            | Random dates
            |--------------------------------------------------------------------------
            |
            | Generate dates within the next 30 days.
            |
            | Friday is skipped.
            |
            |--------------------------------------------------------------------------
            */
            $dates = [];

            $currentDate = Carbon::now($timezone)->startOfDay();

            for ($day = 0; $day < 30; $day++) {

                $date = $currentDate->copy()->addDays($day);

                /*
                | Friday = 5
                */
                if ($date->dayOfWeek === Carbon::FRIDAY) {
                    continue;
                }

                $dates[] = $date->format('Y-m-d');
            }

            /*
            |--------------------------------------------------------------------------
            | Randomly select dates
            |--------------------------------------------------------------------------
            */
            shuffle($dates);

            $selectedDates = array_slice(
                $dates,
                0,
                min(count($dates), ceil($slotCount / 2))
            );

            /*
            |--------------------------------------------------------------------------
            | Generate schedules
            |--------------------------------------------------------------------------
            */
            $createdSlots = 0;

            foreach ($selectedDates as $date) {

                if ($createdSlots >= $slotCount) {
                    break;
                }

                /*
                |--------------------------------------------------------------------------
                | Shuffle times for every service/date
                |--------------------------------------------------------------------------
                |
                | This makes every service have different appointment times.
                |
                |--------------------------------------------------------------------------
                */
                $times = $availableTimes;

                shuffle($times);

                /*
                |--------------------------------------------------------------------------
                | Number of slots for this date
                |--------------------------------------------------------------------------
                */
                $remainingSlots = $slotCount - $createdSlots;

                $dailySlotCount = rand(
                    1,
                    min(4, $remainingSlots)
                );

                $selectedTimes = array_slice(
                    $times,
                    0,
                    $dailySlotCount
                );

                foreach ($selectedTimes as $time) {

                    /*
                    |--------------------------------------------------------------------------
                    | Prevent duplicate schedule
                    |--------------------------------------------------------------------------
                    */
                    $exists = ServiceSchedule::where('service_id', $service->id)
                        ->whereDate('date', $date)
                        ->where('time', $time)
                        ->exists();

                    if ($exists) {
                        continue;
                    }

                    ServiceSchedule::create([
                        'service_id' => $service->id,
                        'date'       => $date,
                        'time'       => $time,
                        'is_booked'  => false,
                    ]);

                    $createdSlots++;

                    if ($createdSlots >= $slotCount) {
                        break;
                    }
                }
            }

            $this->command->info(
                "Created {$createdSlots} schedules for service: {$service->name}"
            );
        }

        $this->command->info('Service schedule seeding completed.');
    }
}
