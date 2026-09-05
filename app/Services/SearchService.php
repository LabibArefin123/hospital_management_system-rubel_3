<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;

class SearchService
{
    /* This is for global search */
    public function search(string $search): array
    {
        $appointments = Appointment::query()
            ->where(fn ($query) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
            )
            ->latest('id')
            ->limit(20)
            ->get();

        $doctors = Doctor::query()
            ->where('name', 'like', "%{$search}%")
            ->latest('id')
            ->limit(20)
            ->get();

        return [
            'status' => true,
            'appointments' => $appointments->map(fn ($appointment) => [
                'name' => $appointment->name ?? '-',
                'status' => $appointment->status ?? 'pending',
                'date' => $appointment->appointment_date
                    ? Carbon::parse($appointment->appointment_date)->format('d M Y')
                    : '-',
                'time' => $appointment->appointment_time
                    ? Carbon::parse($appointment->appointment_time)->format('h:i A')
                    : '-',
            ])->values(),
            'doctors' => $doctors->map(fn ($doctor) => [
                'name' => $doctor->name ?? '-',
                'url' => route('doctor.show', $doctor->id),
            ])->values(),
            'count' => $appointments->count() + $doctors->count(),
        ];
    }
}
