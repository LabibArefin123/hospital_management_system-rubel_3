<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Appointment List
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $appointments = Appointment::with([
                'doctor',
                'service',
                'user'
            ])
                ->latest()
                ->get();
        } else {
            $doctor = Doctor::where('user_id', $user->id)->first();

            if (!$doctor) {
                abort(403, 'Doctor profile not found.');
            }

            $appointments = Appointment::with([
                'doctor',
                'service',
                'user'
            ])
                ->where('type', 'doctor')
                ->where('doctor_id', $doctor->id)
                ->latest()
                ->get();
        }

        $doctorAppointments = $appointments
            ->where('type', 'doctor');

        $serviceAppointments = $appointments
            ->where('type', 'service');

        return view(
            'backend.appointment_section.index',
            compact(
                'appointments',
                'doctorAppointments',
                'serviceAppointments'
            )
        );
    }
    
    public function show($id)
    {
        $user = Auth::user();

        $appointment = Appointment::with([
            'doctor',
            'service',
            'user'
        ])->findOrFail($id);

        if ($user->hasRole('admin')) {
            return view(
                'backend.appointment_section.show',
                compact('appointment')
            );
        }

        if ($user->hasRole('doctor')) {
            $doctor = Doctor::where('user_id', $user->id)->first();

            if (!$doctor) {
                abort(403, 'Doctor profile not found.');
            }

            if (
                $appointment->type !== 'doctor' ||
                $appointment->doctor_id !== $doctor->id
            ) {
                abort(403, 'You are not authorized to view this appointment.');
            }

            return view(
                'backend.appointment_section.show',
                compact('appointment')
            );
        }

        abort(403, 'Unauthorized access.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment Deleted Successfully');
    }

    /**
     * Cancel Appointment
     */
    public function appointment_cancel($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 'Cancelled';

        $appointment->save();

        return redirect()
            ->back()
            ->with('success', 'Appointment Cancelled Successfully');
    }

    public function appointment_change(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        /*
    |--------------------------------------------------------------------------
    | ROLE CHECK
    |--------------------------------------------------------------------------
    */

        if (
            !auth()->user()->hasRole('admin') &&
            !auth()->user()->hasRole('doctor')
        ) {

            abort(403);
        }

        /*
    |--------------------------------------------------------------------------
    | DOCTOR SECURITY
    |--------------------------------------------------------------------------
    */

        if (auth()->user()->hasRole('doctor')) {

            $doctorProfile = Doctor::where(
                'email',
                auth()->user()->email
            )->first();

            if (!$doctorProfile) {

                abort(403);
            }

            if ($appointment->doctor_id != $doctorProfile->id) {

                abort(403);
            }
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

        $appointment->status = $request->status;

        $appointment->save();

        return back()->with(
            'success',
            'Appointment status updated successfully.'
        );
    }
}
