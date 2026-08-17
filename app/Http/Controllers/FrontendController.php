<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\SystemProblem;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Contact;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('frontend.welcome', compact('doctors'));
    }

    public function doctor(Request $request)
    {
        $search = $request->query('search');

        $doctors = Doctor::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('speciality', 'like', "%$search%");
        })->get();

        return view('frontend.doctor_page.doctor', compact('doctors', 'search'));
    }

    public function doctor_show($id)
    {
        $doctor = \App\Models\Doctor::with([
            'schedules' => function ($query) {
                $query->where('is_booked', false)
                    ->orderBy('date')
                    ->orderBy('time');
            }
        ])->findOrFail($id);

        // Group schedules by date
        $groupedSchedules = $doctor->schedules
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
            });

        // Paginate manually (3 dates per page)
        $schedulePages = $groupedSchedules->chunk(3);

        return view(
            'frontend.doctor_page.doctor_information.show',
            compact(
                'doctor',
                'groupedSchedules',
                'schedulePages'
            )
        );
    }

    public function service_show($id)
    {
        $service = Service::findOrFail($id);

        return view('frontend.service_page.service_information.show', compact('service'));
    }

    public function contact()
    {
        return view('frontend.contact_page.contact');
    }

    public function contact_store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'name' => 'required|string|max:255|unique:contacts,name',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email',
                'department' => 'nullable|string',
                'service' => 'nullable|string',
                'message' => 'nullable|string',
            ]);

            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'department' => $request->department,
                'service' => $request->service,
                'message' => $request->message,
            ]);

            DB::commit();

            return back()->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Something went wrong! Please try again.']);
        }
    }

    public function service()
    {
        $services = Service::all();

        return view('frontend.service_page.service', compact('services'));
    }

    public function appointment()
    {
        $doctorAppointments = Appointment::with('doctor')
            ->whereNotNull('doctor_id')
            ->latest()
            ->get();

        $serviceAppointments = Appointment::with('service')
            ->whereNotNull('service_id')
            ->latest()
            ->get();

        return view('frontend.appointment_page.appointment', compact(
            'doctorAppointments',
            'serviceAppointments'
        ));
    }

    public function appointment_store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:doctor,service',
            'name' => 'required|string',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'gender' => 'required',
            'payment_method' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'email' => $request->payment_method === 'Online'
                ? 'required|email'
                : 'nullable|email',
        ], [
            'email.required' => 'Email is required for online payment.',
        ]);

        DB::beginTransaction();

        try {
            $status = $request->payment_method === 'Online'
                ? 'pending'
                : 'pending';

            if ($request->type === 'doctor') {
                $doctor = Doctor::findOrFail($request->doctor_id);

                $slotBooked = Appointment::where('doctor_id', $doctor->id)
                    ->where('appointment_date', $request->appointment_date)
                    ->where('appointment_time', $request->appointment_time)
                    ->exists();

                if ($slotBooked) {
                    DB::rollBack();

                    return back()
                        ->withInput()
                        ->withErrors([
                            'appointment_time' => 'This time slot is already booked.'
                        ]);
                }

                $appointment = Appointment::create([
                    'type' => 'doctor',
                    'doctor_id' => $doctor->id,
                    'user_id' => auth()->id(),
                    'name' => $request->name,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'appointment_date' => $request->appointment_date,
                    'appointment_time' => $request->appointment_time,
                    'payment_method' => $request->payment_method,
                    'amount' => $doctor->consultation_fee,
                    'status' => $status,
                ]);
            } elseif ($request->type === 'service') {
                $service = Service::findOrFail($request->service_id);

                $appointment = Appointment::create([
                    'type' => 'service',
                    'service_id' => $service->id,
                    'user_id' => auth()->id(),
                    'name' => $request->name,
                    'age' => $request->age,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'appointment_date' => $request->appointment_date,
                    'appointment_time' => $request->appointment_time,
                    'payment_method' => $request->payment_method,
                    'amount' => $service->price,
                    'status' => $status,
                ]);
            }

            DB::commit();

            if ($request->payment_method === 'Online') {
                return redirect()->route(
                    'payment.page',
                    $appointment->id
                );
            }

            return back()->with(
                'success',
                'Appointment booked successfully'
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }

    public function payment_store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'amount' => 'required|numeric|min:1',
            'card_number' => 'required|min:12|max:19',
            'expiry' => 'required',
            'cvv' => 'required|min:3|max:4',
        ]);

        $appointment = Appointment::findOrFail(
            $request->appointment_id
        );

        if ((float) $request->amount !== (float) $appointment->amount) {
            return back()->with(
                'error',
                'Please pay the full amount!'
            );
        }

        $cardNumber = preg_replace(
            '/\s+/',
            '',
            $request->card_number
        );

        if (strlen($cardNumber) < 12) {
            return back()->with(
                'error',
                'Invalid Card Number'
            );
        }

        $paymentFor = $appointment->type === 'doctor'
            ? 'Doctor: ' . optional($appointment->doctor)->name
            : 'Service: ' . optional($appointment->service)->name;

        Payment::create([
            'user_id' => auth()->id(),
            'appointment_id' => $appointment->id,
            'payment_method' => 'Card',
            'transaction_id' => 'TXN_' . strtoupper(Str::random(10)),
            'amount' => $appointment->amount,
            'card_number' => substr($cardNumber, -4),
            'expiry' => $request->expiry,
            'cvv' => $request->cvv,
            'status' => 'paid',
        ]);

        $appointment->update([
            'status' => 'confirmed'
        ]);

        if ($appointment->type === 'doctor') {
            return redirect()
                ->route('doctor.show', $appointment->doctor_id)
                ->with(
                    'success',
                    'Payment successful! Doctor appointment confirmed.'
                );
        }

        return redirect()
            ->route('service.show', $appointment->service_id)
            ->with(
                'success',
                'Payment successful! Service booked successfully.'
            );
    }

    public function payment_page($id)
    {
        $appointment = Appointment::with(['doctor', 'service'])
            ->where('id', $id)
            ->firstOrFail();

        return view('frontend.payment_page.payment', compact('appointment'));
    }


    public function searchData(Request $request)
    {
        $search = trim($request->query('search', ''));

        /* Empty Search */
        if ($search === '') {

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'patients' => [],
                    'doctors' => [],
                    'count' => 0,
                ]);
            }

            return view('frontend.search', [
                'search' => '',
                'patients' => collect(),
                'doctors' => collect(),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | USER / PATIENT SEARCH
    |--------------------------------------------------------------------------
    | Patient data is now stored in users table.
    */
        $patients = User::query()
            ->where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->limit(20)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | DOCTOR SEARCH
    |--------------------------------------------------------------------------
    */
        $doctors = Doctor::query()
            ->where(function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->limit(20)
            ->get();

        /*
    |--------------------------------------------------------------------------
    | AJAX RESPONSE
    |--------------------------------------------------------------------------
    */
        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                /*
            |--------------------------------------------------------------------------
            | PATIENTS / USERS
            |--------------------------------------------------------------------------
            */
                'patients' => $patients->map(function ($user) {

                    return [
                        'id' => $user->id,

                        'name' => $user->name ?? '-',

                        'patient_code' => $user->patient_code ?? '-',

                        'phone' => $user->phone ?? '-',

                        'email' => $user->email ?? '-',

                        'photo' => !empty($user->patient_image)
                            ? asset(
                                'uploads/images/patients/' .
                                    $user->patient_image
                            )
                            : asset(
                                'uploads/images/default.jpg'
                            ),

                        'created_at' => optional($user->created_at)
                            ->format('d M Y'),

                        'url' => route(
                            'patients.show',
                            $user->id
                        ),
                    ];
                })->values(),

                /*
            |--------------------------------------------------------------------------
            | DOCTORS
            |--------------------------------------------------------------------------
            */
                'doctors' => $doctors->map(function ($doctor) {

                    return [
                        'id' => $doctor->id,

                        'name' => $doctor->name ?? '-',

                        'speciality' => $doctor->speciality ?? '-',

                        'phone' => $doctor->phone ?? '-',

                        'email' => $doctor->email ?? '-',

                        'experience_years' =>
                        $doctor->experience_years ?? 0,

                        'image' => $doctor->image
                            ? asset($doctor->image)
                            : asset(
                                'uploads/images/default.jpg'
                            ),

                        'url' => route(
                            'doctor.show',
                            $doctor->id
                        ),
                    ];
                })->values(),

                /*
            |--------------------------------------------------------------------------
            | TOTAL RESULT COUNT
            |--------------------------------------------------------------------------
            */
                'count' =>
                $patients->count() +
                    $doctors->count(),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | NORMAL SEARCH PAGE
    |--------------------------------------------------------------------------
    */
        return view(
            'frontend.search',
            compact(
                'search',
                'patients',
                'doctors'
            )
        );
    }

    public function newsletter_store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    'email',
                    'unique:newsletters,email',
                    function ($attribute, $value, $fail) {

                        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $value)) {
                            $fail('Invalid email format.');
                        }

                        $domain = explode('@', $value)[1] ?? null;

                        if (!$domain || strlen($domain) < 5) {
                            $fail('Invalid email domain.');
                        }
                    }
                ],
            ]);

            if ($validator->fails()) {

                // 🔴 LOG VALIDATION ERROR
                Log::warning('Newsletter validation failed', [
                    'email' => $request->email,
                    'errors' => $validator->errors()->all(),
                    'ip' => $request->ip(),
                ]);

                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $email = $request->email;
            $domain = explode('@', $email)[1];

            Newsletter::create([
                'email' => $email,
                'domain' => $domain,
            ]);

            return back()->with('success', 'Subscribed successfully!');
        } catch (\Exception $e) {

            // 🔴 SYSTEM ERROR LOG
            Log::error('Newsletter subscription error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'email' => $request->email,
            ]);

            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
