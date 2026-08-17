<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Appointment List
     */
    public function index()
    {
        $appointments = Appointment::with([
            'doctor',
            'service',
            'user'
        ])
            ->latest()
            ->get();

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
        $appointment = Appointment::with([
            'doctor',
            'service',
            'user'
        ])
            ->findOrFail($id);

        return view(
            'backend.appointment_section.show',
            compact('appointment')
        );
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
