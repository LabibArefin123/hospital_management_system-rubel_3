<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Payment;
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
            $doctorAppointments = Appointment::with(['doctor', 'service', 'user'])
                ->where('type', 'doctor')
                ->latest()
                ->paginate(8, ['*'], 'doctor_page');
            $serviceAppointments = Appointment::with(['doctor', 'service', 'user'])
                ->where('type', 'service')
                ->latest()
                ->paginate(8, ['*'], 'service_page');
        } elseif ($user->hasRole('doctor')) {
            $doctor = Doctor::where('user_id', $user->id)->first();
            if (!$doctor) {
                abort(403, 'Doctor profile not found.');
            }
            $doctorAppointments = Appointment::with(['doctor', 'service', 'user'])
                ->where('type', 'doctor')
                ->where('doctor_id', $doctor->id)
                ->latest()
                ->paginate(8, ['*'], 'doctor_page');
            $serviceAppointments = null;
        } else {
            abort(403);
        }

        $formatAppointments = function ($appointments) {
            if (!$appointments) {
                return null;
            }
            $appointments->getCollection()->transform(function ($appointment) {
                $appointment->formatted_date = $appointment->appointment_date
                    ? Carbon::parse($appointment->appointment_date)->format('d M Y')
                    : 'N/A';
                $appointment->formatted_time = $appointment->appointment_time
                    ? Carbon::parse($appointment->appointment_time)->format('h:i A')
                    : 'N/A';
                $appointment->patient_image = ($appointment->user && $appointment->user->profile_picture)
                    ? asset($appointment->user->profile_picture)
                    : asset('uploads/images/default.jpg');
                $appointment->doctor_image = ($appointment->doctor && $appointment->doctor->image)
                    ? asset($appointment->doctor->image)
                    : asset('uploads/images/default.jpg');
                $appointment->service_image = ($appointment->service && $appointment->service->image)
                    ? asset($appointment->service->image)
                    : asset('uploads/images/default.jpg');
                $appointment->patient_age = $appointment->age ?? 'N/A';
                $appointment->patient_gender = $appointment->gender ?? 'N/A';
                $appointment->patient_phone = $appointment->phone ?? ($appointment->user->phone ?? 'N/A');
                $appointment->patient_email = $appointment->email ?? ($appointment->user->email ?? 'N/A');
                $appointment->doctor_name = $appointment->doctor->name ?? 'N/A';
                $appointment->doctor_speciality = $appointment->doctor->speciality ?? 'N/A';
                $appointment->service_title = $appointment->service->title ?? 'N/A';
                $appointment->amount_formatted = number_format($appointment->amount ?? 0, 2);
                $appointment->search_text = strtolower(
                    ($appointment->name ?? '') . ' ' .
                        ($appointment->phone ?? '') . ' ' .
                        ($appointment->doctor->name ?? '') . ' ' .
                        ($appointment->doctor->speciality ?? '') . ' ' .
                        ($appointment->service->title ?? '')
                );
                return $appointment;
            });
            return $appointments;
        };

        $doctorAppointments = $formatAppointments($doctorAppointments);
        $serviceAppointments = $formatAppointments($serviceAppointments);
        return view('backend.appointment_section.index', compact('doctorAppointments', 'serviceAppointments'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $appointment = Appointment::with([
            'doctor',
            'service',
            'user'
        ])->findOrFail($id);

        $payment = Payment::where(
            'appointment_id',
            $appointment->id
        )->first();

        if ($user->hasRole('admin')) {
            return view(
                'backend.appointment_section.show',
                compact(
                    'appointment',
                    'payment'
                )
            );
        }

        if ($user->hasRole('doctor')) {
            $doctor = Doctor::where(
                'user_id',
                $user->id
            )->first();

            if (!$doctor) {
                abort(403, 'Doctor profile not found.');
            }

            if (
                $appointment->type !== 'doctor' ||
                $appointment->doctor_id !== $doctor->id
            ) {
                abort(
                    403,
                    'You are not authorized to view this appointment.'
                );
            }

            return view(
                'backend.appointment_section.show',
                compact(
                    'appointment',
                    'payment'
                )
            );
        }

        if ($user->hasRole('user')) {

            if ($appointment->user_id !== $user->id) {
                abort(
                    403,
                    'You are not authorized to view this appointment.'
                );
            }

            return view(
                'backend.appointment_section.show',
                compact(
                    'appointment',
                    'payment'
                )
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
        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $appointment->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Appointment cancelled successfully.');
    }

    public function appointment_change(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        /* ROLE CHECK */
        if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('doctor')) {
            abort(403);
        }

        /* DOCTOR SECURITY */
        if (auth()->user()->hasRole('doctor')) {
            $doctorProfile = Doctor::where('user_id', auth()->id())->first();

            if (!$doctorProfile) {
                abort(403);
            }

            if ($appointment->doctor_id != $doctorProfile->id) {
                abort(403);
            }
        }

        /* VALIDATION */
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        /* UPDATE */
        $appointment->status = $request->status;
        $appointment->save();
        return back()->with('success', 'Appointment status updated successfully.');
    }
}
