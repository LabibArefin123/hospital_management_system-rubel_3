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
        $doctor = Doctor::with([
            'schedules' => function ($query) {
                $query->orderBy('date')
                    ->orderBy('time');
            }
        ])->findOrFail($id);

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->pluck('id', 'appointment_date');

        $bookedSlots = Appointment::where('doctor_id', $doctor->id)
            ->get(['appointment_date', 'appointment_time'])
            ->mapWithKeys(function ($appointment) {
                $date = \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d');
                $time = \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i');

                return [
                    $date . '|' . $time => true
                ];
            })
            ->toArray();

        $groupedSchedules = $doctor->schedules
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
            });

        $schedulePages = $groupedSchedules->chunk(3);

        return view(
            'frontend.doctor_page.doctor_information.show',
            compact(
                'doctor',
                'groupedSchedules',
                'schedulePages',
                'bookedSlots'
            )
        );
    }

    public function service_show($id)
    {
        $service = \App\Models\Service::with([
            'schedules' => function ($query) {
                $query
                    ->orderBy('date')
                    ->orderBy('time');
            }
        ])->findOrFail($id);

        /*
    |--------------------------------------------------------------------------
    | Group schedules by date
    |--------------------------------------------------------------------------
    */

        $groupedSchedules = $service->schedules
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
            });

        /*
    |--------------------------------------------------------------------------
    | Paginate manually
    | 3 dates per page
    |--------------------------------------------------------------------------
    */

        $schedulePages = $groupedSchedules->chunk(3);

        return view(
            'frontend.service_page.service_information.show',
            compact(
                'service',
                'groupedSchedules',
                'schedulePages'
            )
        );
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
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:50',
            'gender' => 'required|in:Male,Female',
            'payment_method' => 'required|in:Online,Cash',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'email' => $request->payment_method === 'Online'
                ? 'required|email'
                : 'nullable|email',
            'doctor_id' => $request->type === 'doctor'
                ? 'required|exists:doctors,id'
                : 'nullable',
            'service_id' => $request->type === 'service'
                ? 'required|exists:services,id'
                : 'nullable',
        ], [
            'email.required' => 'Email is required for online payment.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Invalid payment method selected.',
            'doctor_id.required' => 'Doctor is required.',
            'doctor_id.exists' => 'Selected doctor was not found.',
            'service_id.required' => 'Service is required.',
            'service_id.exists' => 'Selected service was not found.',
        ]);

        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->withInput()
                ->with('error', 'Please login before booking an appointment.');
        }

        DB::beginTransaction();

        try {
            $appointment = null;

            if ($request->type === 'doctor') {
                $doctor = Doctor::findOrFail($request->doctor_id);

                $slotBooked = Appointment::where('type', 'doctor')
                    ->where('doctor_id', $doctor->id)
                    ->whereDate('appointment_date', $request->appointment_date)
                    ->whereTime('appointment_time', $request->appointment_time)
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
                    'service_id' => null,
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
                    'status' => 'pending',
                ]);
            }

            if ($request->type === 'service') {
                $service = Service::findOrFail($request->service_id);

                $appointment = Appointment::create([
                    'type' => 'service',
                    'doctor_id' => null,
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
                    'status' => 'pending',
                ]);
            }

            DB::commit();

            if (!$appointment) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'error' => 'Unable to create appointment.'
                    ]);
            }

            if ($request->payment_method === 'Online') {
                return redirect()
                    ->route('payment.page', ['id' => $appointment->id]);
            }

            if ($appointment->type === 'doctor') {
                return redirect()
                    ->route('doctor.show', $appointment->doctor_id)
                    ->with('success', 'Doctor appointment booked successfully.');
            }

            return redirect()
                ->route('service.show', $appointment->service_id)
                ->with('success', 'Service appointment booked successfully.');
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
            'payment_method' => 'required|in:bkash,nagad,rocket',
            'transaction_id' => 'required|string|max:255',
            'payment_reference' => 'required|string|max:255',
        ], [
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Invalid payment method selected.',
            'transaction_id.required' => 'Transaction ID is required.',
            'payment_reference.required' => 'Please enter your payment reference.',
        ]);

        DB::beginTransaction();

        try {
            $appointment = Appointment::with([
                'doctor',
                'service',
            ])->findOrFail($request->appointment_id);

            if ($appointment->user_id !== auth()->id()) {
                DB::rollBack();

                return back()
                    ->withInput()
                    ->with('error', 'You are not authorized to make payment for this appointment.');
            }

            if ((float)$request->amount !== (float)$appointment->amount) {
                DB::rollBack();

                return back()
                    ->withInput()
                    ->with('error', 'Please pay the full amount!');
            }

            $existingPayment = Payment::where('appointment_id', $appointment->id)->first();

            if ($existingPayment) {
                DB::rollBack();

                return back()->with(
                    'error',
                    'Payment has already been submitted for this appointment.'
                );
            }

            $transactionId = trim($request->transaction_id);
            $paymentReference = trim($request->payment_reference);

            $existingTransaction = Payment::where(
                'transaction_id',
                $transactionId
            )->exists();

            if ($existingTransaction) {
                DB::rollBack();

                return back()
                    ->withInput()
                    ->with('error', 'This transaction ID has already been used.');
            }

            $payment = Payment::create([
                'user_id' => auth()->id(),
                'appointment_id' => $appointment->id,
                'payment_method' => strtolower($request->payment_method),
                'transaction_id' => $transactionId,
                'payment_reference' => $paymentReference,
                'amount' => $appointment->amount,
                'status' => 'paid',
            ]);

            $appointment->update([
                'status' => 'confirmed',
            ]);

            DB::commit();

            if ($appointment->type === 'doctor') {
                return redirect()
                    ->route('doctor.show', $appointment->doctor_id)
                    ->with(
                        'success',
                        'Payment successful! Your doctor appointment has been confirmed. Payment reference: ' . $paymentReference
                    );
            }

            return redirect()
                ->route('service.show', $appointment->service_id)
                ->with(
                    'success',
                    'Payment successful! Your service appointment has been confirmed. Payment reference: ' . $paymentReference
                );
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function payment_page($id)
    {
        $appointment = Appointment::with(['doctor', 'service'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($appointment->payment_method !== 'Online') {
            return redirect()
                ->back()
                ->with('error', 'This appointment does not require online payment.');
        }

        $existingPayment = Payment::where('appointment_id', $appointment->id)->first();

        if ($existingPayment) {
            return redirect()
                ->back()
                ->with('error', 'Payment has already been submitted for this appointment.');
        }

        $transactionId = 'TXN' . strtoupper(Str::random(12));

        return view(
            'frontend.payment_page.payment',
            compact('appointment', 'transactionId')
        );
    }

    public function searchData(Request $request)
    {
        $search = trim($request->query('search', ''));

        if ($search === '') {
            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'appointments' => [],
                    'doctors' => [],
                    'count' => 0,
                ]);
            }

            return view('frontend.search', [
                'search' => '',
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | APPOINTMENT SEARCH
    |--------------------------------------------------------------------------
    | Guest appointment information is stored directly in appointments.
    | Everyone can search appointment/patient names.
    |--------------------------------------------------------------------------
    */

        $appointments = Appointment::query()
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest('id')
            ->limit(20)
            ->get();

        /* DOCTOR SEARCH */
        $doctors = Doctor::query()
            ->where('name', 'like', "%{$search}%")
            ->latest('id')
            ->limit(20)
            ->get();

        /*| AJAX RESPONSE */
        if ($request->ajax()) {
            return response()->json([
                'status' => true,

                'appointments' => $appointments->map(function ($appointment) {
                    return [
                        'name' => $appointment->name ?? '-',
                        'status' => $appointment->status ?? 'pending',
                        'date' => $appointment->appointment_date
                            ? \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y')
                            : '-',
                        'time' => $appointment->appointment_time
                            ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A')
                            : '-',
                    ];
                })->values(),

                'doctors' => $doctors->map(function ($doctor) {
                    return [
                        'name' => $doctor->name ?? '-',
                        'url' => route('doctor.show', $doctor->id),
                    ];
                })->values(),

                'count' => $appointments->count() + $doctors->count(),
            ]);
        }

        return view('frontend.search', [
            'search' => $search,
        ]);
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
