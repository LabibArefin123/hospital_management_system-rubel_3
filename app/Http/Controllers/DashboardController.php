<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Payment;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function admin_dashboard()
    {
        $user = Auth::user();

        /* TOTAL APPOINTMENTS */
        $totalAppointments = Appointment::count();

        /* TOTAL EARNINGS */
        $totalEarnings = Appointment::where('status', 'confirmed')->sum('amount');

        /* CONFIRMED APPOINTMENTS */
        $completedAppointments = Appointment::where('status', 'confirmed')->count();

        /* PENDING APPOINTMENTS */
        $pendingAppointments = Appointment::where('status', 'pending')->count();

        /* CANCELLED APPOINTMENTS */
        $cancelledAppointments = Appointment::where('status', 'cancelled')->count();

        /* LATEST APPOINTMENTS */
        $latestAppointments = Appointment::with(['doctor', 'service'])
            ->latest()
            ->get();

        /* DOCTOR APPOINTMENTS */
        $doctorAppointments = Appointment::with(['doctor'])
            ->whereNotNull('doctor_id')
            ->latest()
            ->paginate(8, ['*'], 'doctor_page');

        /* SERVICE APPOINTMENTS */
        $serviceAppointments = Appointment::with(['service'])
            ->whereNotNull('service_id')
            ->whereNull('doctor_id')
            ->latest()
            ->paginate(8, ['*'], 'service_page');

        /* DASHBOARD VIEW */
        return view('backend.dashboard.dashboard_admin', compact(
            'user',
            'totalAppointments',
            'totalEarnings',
            'completedAppointments',
            'cancelledAppointments',
            'pendingAppointments',
            'latestAppointments',
            'doctorAppointments',
            'serviceAppointments'
        ));
    }

    public function doctor_dashboard()
    {
        $user = Auth::user();

        /* FIND DOCTOR USING LOGGED-IN USER ID */
        $doctor = Doctor::where('user_id', $user->id)->first();

        if (!$doctor) {
            abort(403, 'Doctor profile not found.');
        }

        /* DOCTOR ID */
        $doctorId = $doctor->id;

        /* TOTAL APPOINTMENTS FOR THIS DOCTOR ONLY */
        $totalAppointments = Appointment::where('doctor_id', $doctorId)->count();

        /* TOTAL EARNINGS FOR THIS DOCTOR ONLY */
        $totalEarnings = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'confirmed')
            ->sum('amount');

        /* COMPLETED APPOINTMENTS FOR THIS DOCTOR ONLY */
        $completedAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'confirmed')
            ->count();

        $pendingAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'pending')
            ->count();

        /* CANCELLED APPOINTMENTS FOR THIS DOCTOR ONLY */
        $cancelledAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'cancelled')
            ->count();

        /* LATEST APPOINTMENTS FOR THIS DOCTOR ONLY */
        $latestAppointments = Appointment::with('doctor')
            ->where('doctor_id', $doctorId)
            ->latest()
            ->get();

        /* ALL APPOINTMENTS FOR THIS DOCTOR ONLY */
        $appointments = Appointment::with('doctor')
            ->where('doctor_id', $doctorId)
            ->latest()
            ->get();

        /* PAGINATED APPOINTMENTS FOR THIS DOCTOR ONLY */
        $doctorAppointments = Appointment::with('doctor')
            ->where('doctor_id', $doctorId)
            ->latest()
            ->paginate(8, ['*'], 'doctor_page');

        return view('backend.dashboard.dashboard_doctor', compact(
            'doctor',
            'totalAppointments',
            'totalEarnings',
            'completedAppointments',
            'pendingAppointments',
            'cancelledAppointments',
            'latestAppointments',
            'appointments',
            'doctorAppointments'
        ));
    }

    public function user_dashboard()
    {
        $user = Auth::user();

        /* APPOINTMENT COUNTS */
        $userAppointments = Appointment::where('user_id', $user->id);
        $totalAppointments = (clone $userAppointments)->count();
        $confirmedAppointments = (clone $userAppointments)->where('status', 'confirmed')->count();
        $pendingAppointments = (clone $userAppointments)->where('status', 'pending')->count();
        $cancelledAppointments = (clone $userAppointments)->where('status', 'cancelled')->count();

        /* TOTAL PAID */
        $totalPaid = Payment::where('user_id', $user->id)
            ->where('status', 'paid')
            ->sum('amount');

        /* PAID APPOINTMENT IDS */
        $paidAppointmentIds = Payment::where('user_id', $user->id)
            ->where('status', 'paid')
            ->whereNotNull('appointment_id')
            ->pluck('appointment_id')
            ->unique();

        /* CASH RECEIVED */
        $cashReceived = Appointment::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->whereNotIn('id', $paidAppointmentIds)
            ->sum('amount');

        /* CASH PENDING */
        $cashPending = Appointment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->sum('amount');

        /* LATEST APPOINTMENTS */
        $latestAppointments = Appointment::with(['doctor', 'service'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        /* ALL APPOINTMENTS */
        $appointments = Appointment::with(['doctor', 'service'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(8);

        return view('backend.dashboard.dashboard_user', compact(
            'user',
            'totalAppointments',
            'confirmedAppointments',
            'pendingAppointments',
            'cancelledAppointments',
            'totalPaid',
            'cashReceived',
            'cashPending',
            'paidAppointmentIds',
            'latestAppointments',
            'appointments'
        ));
    }
}
