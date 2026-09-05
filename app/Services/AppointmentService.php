<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Service;
use App\Models\ServiceSchedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
    /* This is for appointment access restriction */
    public function bookingRestriction(): ?string
    {
        if (!Auth::check()) {
            return null;
        }

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return 'Admin users are not allowed to book appointments.';
        }

        if ($user->hasRole('doctor')) {
            return 'Doctors are not allowed to book appointments.';
        }

        return null;
    }

    /* This is for appointment creation */
    public function create(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {
            return $data['type'] === 'doctor'
                ? $this->createDoctorAppointment($data)
                : $this->createServiceAppointment($data);
        });
    }

    /* This is for doctor appointment creation */
    protected function createDoctorAppointment(array $data): Appointment
    {
        $doctor = Doctor::findOrFail($data['doctor_id']);

        $schedule = DoctorSchedule::where('doctor_id', $doctor->id)
            ->whereDate('date', $data['appointment_date'])
            ->whereTime('time', $data['appointment_time'])
            ->where('is_booked', false)
            ->lockForUpdate()
            ->first();

        if (!$schedule) {
            throw ValidationException::withMessages([
                'appointment_time' => 'This doctor time slot is not available or has already been booked.',
            ]);
        }

        $appointment = $this->appointmentData($data, [
            'doctor_id' => $doctor->id,
            'service_id' => null,
            'amount' => $doctor->consultation_fee,
        ]);

        $schedule->update(['is_booked' => true]);

        return Appointment::create($appointment);
    }

    /* This is for service appointment creation */
    protected function createServiceAppointment(array $data): Appointment
    {
        $service = Service::findOrFail($data['service_id']);

        $schedule = ServiceSchedule::where('service_id', $service->id)
            ->whereDate('date', $data['appointment_date'])
            ->whereTime('time', $data['appointment_time'])
            ->where('is_booked', false)
            ->lockForUpdate()
            ->first();

        if (!$schedule) {
            throw ValidationException::withMessages([
                'appointment_time' => 'This service time slot is not available or has already been booked.',
            ]);
        }

        $appointment = $this->appointmentData($data, [
            'doctor_id' => null,
            'service_id' => $service->id,
            'amount' => $service->price,
        ]);

        $schedule->update(['is_booked' => true]);

        return Appointment::create($appointment);
    }

    /* This is for common appointment data */
    protected function appointmentData(array $data, array $extra): array
    {
        return array_merge([
            'user_id' => Auth::id(),
            'type' => $data['type'],
            'name' => $data['name'],
            'age' => $data['age'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'email' => $data['email'] ?? null,
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'payment_method' => $data['payment_method'],
            'status' => 'pending',
        ], $extra);
    }

    /* This is for appointment listing queries */
    public function listingQueries($user): array
    {
        $doctor = Appointment::with('doctor')->whereNotNull('doctor_id');
        $service = Appointment::with('service')->whereNotNull('service_id');
        $this->applyUserScope($doctor, $service, $user);
        return [$doctor, $service];
    }

    /* This is for appointment role scope */
    protected function applyUserScope(Builder $doctor, Builder $service, $user): void
    {
        if (!$user) {
            // $doctor->whereRaw('1 = 0');
            // $service->whereRaw('1 = 0');
            return;
        }

        if ($user->hasRole('doctor')) {
            $doctorModel = $user->doctor;

            $doctorModel
                ? $doctor->where('doctor_id', $doctorModel->id)
                : $doctor->whereRaw('1 = 0');

            $service->whereRaw('1 = 0');
            return;
        }

        if ($user->hasRole('user')) {
            $doctor->where('user_id', $user->id);
            $service->where('user_id', $user->id);
        }
        /* This is for admin access */
    }

    /* This is for doctor appointment filtering */
    public function doctorFilter($request, $user): Builder
    {
        [$doctor, $service] = $this->listingQueries($user);

        return $doctor
            ->when(
                $request->filled('doctor_id') && $user?->hasRole('admin'),
                fn ($query) => $query->where('doctor_id', $request->doctor_id)
            )
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where('status', $request->status)
            )
            ->when(
                $request->filled('appointment_date'),
                fn ($query) => $query->whereDate('appointment_date', $request->appointment_date)
            );
    }

    /* This is for service appointment filtering */
    public function serviceFilter($request, $user): Builder
    {
        [$doctor, $service] = $this->listingQueries($user);

        return $service
            ->when(
                $request->filled('service_id') && $user?->hasRole('admin'),
                fn ($query) => $query->where('service_id', $request->service_id)
            )
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where('status', $request->status)
            )
            ->when(
                $request->filled('appointment_date'),
                fn ($query) => $query->whereDate('appointment_date', $request->appointment_date)
            );
    }

    /* This is for cash appointment redirect */
    public function cashRedirect(Appointment $appointment)
    {
        $route = $appointment->type === 'doctor' ? 'doctor.show' : 'service.show';
        $id = $appointment->type === 'doctor' ? $appointment->doctor_id : $appointment->service_id;
        $message = $appointment->type === 'doctor'
            ? 'Doctor appointment booked successfully.'
            : 'Service appointment booked successfully.';

        return redirect()->route($route, $id)->with('success', $message);
    }

    /* This is for doctor details data */
    public function doctorDetails($id): array
    {
        $doctor = Doctor::with([
            'schedules' => fn ($q) => $q->orderBy('date')->orderBy('time'),
        ])->findOrFail($id);

        $bookedSlots = Appointment::where('doctor_id', $doctor->id)
            ->get(['appointment_date', 'appointment_time'])
            ->mapWithKeys(fn ($a) => [
                $a->appointment_date . '|' . \Carbon\Carbon::parse($a->appointment_time)->format('H:i') => true,
            ])->toArray();

        $groupedSchedules = $doctor->schedules->groupBy(
            fn ($s) => \Carbon\Carbon::parse($s->date)->format('Y-m-d')
        );

        return [
            'doctor' => $doctor,
            'groupedSchedules' => $groupedSchedules,
            'schedulePages' => $groupedSchedules->chunk(3),
            'bookedSlots' => $bookedSlots,
            'userAppointment' => $this->latestUserAppointment(),
        ];
    }

    /* This is for service details data */
    public function serviceDetails($id): array
    {
        $service = Service::with([
            'schedules' => fn ($q) => $q
                ->whereDate('date', '>=', now('Asia/Dhaka')->toDateString())
                ->whereRaw('DAYOFWEEK(date) != ?', [6])
                ->orderBy('date')->orderBy('time'),
        ])->findOrFail($id);

        $oldDate = old('appointment_date');
        $oldTime = old('appointment_time');

        $prepared = $service->schedules->groupBy(fn ($s) => $s->date->format('Y-m-d'))
            ->map(function ($schedules, $date) use ($oldDate, $oldTime) {
                return [
                    'date' => $date,
                    'day_name' => $schedules->first()->date->format('l'),
                    'formatted_date' => $schedules->first()->date->format('d M Y'),
                    'schedules' => $schedules->map(function ($s) use ($oldDate, $oldTime) {
                        $slotDate = $s->date->format('Y-m-d');
                        $slotTime = \Carbon\Carbon::parse($s->time)->format('H:i:s');
                        $occupied = (bool) $s->is_booked;

                        /* This is for failed slot selection */
                        if ($oldDate === $slotDate && $oldTime === $slotTime &&
                            session()->has('errors') && session('errors')->has('appointment_time')) {
                            $occupied = true;
                        }

                        return [
                            'id' => $s->id, 'date' => $slotDate, 'time' => $slotTime,
                            'formatted_time' => \Carbon\Carbon::parse($s->time)->format('h:i A'),
                            'is_occupied' => $occupied,
                            'is_selected' => !$occupied && $oldDate === $slotDate && $oldTime === $slotTime,
                        ];
                    })->values(),
                ];
            })->values();

        return [
            'service' => $service,
            'schedulePages' => $prepared->chunk(3)->values(),
            'userAppointment' => $this->latestUserAppointment(),
        ];
    }

    /* This is for latest user appointment */
    private function latestUserAppointment()
    {
        return Auth::check() && Auth::user()->hasRole('user')
            ? Appointment::where('user_id', Auth::id())->latest('id')->first()
            : null;
    }

}
