<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Carbon\Carbon;

class DoctorScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Clear old data
        DoctorSchedule::truncate();

        $doctors = Doctor::all();

        // Fixed slots (realistic hospital timing)
        $timeSlots = [
            '09:00:00',
            '10:00:00',
            '11:00:00',
            '12:00:00',
            '14:00:00',
            '16:00:00',
        ];

        foreach ($doctors as $index => $doctor) {

            // 🎯 Days per doctor
            if ($index < 2) {
                $days = 2;
            } elseif ($index < 5) {
                $days = 3;
            } else {
                $days = 4;
            }

            for ($i = 0; $i < $days; $i++) {

                $date = Carbon::now()->addDays($i);

                // 🎯 Slots per day (1–4)
                $slotsCount = rand(1, 4);

                $selectedSlots = collect($timeSlots)
                    ->shuffle()
                    ->take($slotsCount);

                foreach ($selectedSlots as $time) {
                    DoctorSchedule::create([
                        'doctor_id' => $doctor->id,
                        'date' => $date->format('Y-m-d'),
                        'time' => $time,
                        'is_booked' => false,
                    ]);
                }
            }
        }
    }
}
