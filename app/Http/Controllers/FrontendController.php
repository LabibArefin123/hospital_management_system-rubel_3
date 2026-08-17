<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\SystemProblem;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Contact;
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
            ->where('user_id', auth()->id())
            ->whereNotNull('doctor_id')
            ->latest()
            ->get();

        $serviceAppointments = Appointment::with('service')
            ->where('user_id', auth()->id())
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

            'type'              => 'required|in:doctor,service',
            'name'              => 'required|string',
            'age'               => 'required|integer',
            'phone'             => 'required|string',
            'gender'            => 'required',
            'payment_method'    => 'required',
            'appointment_date'  => 'required|date',
            'appointment_time'  => 'required',

            // EMAIL REQUIRED ONLY FOR ONLINE PAYMENT
            'email' => $request->payment_method === 'Online'
                ? 'required|email'
                : 'nullable|email',

        ], [

            'email.required' => 'Email is required for online payment.',

        ]);

        DB::beginTransaction();

        try {

            $status = $request->payment_method === 'Online'
                ? 'confirmed'
                : 'pending';

            /* ================= DOCTOR ================= */

            if ($request->type === 'doctor') {

                $doctor = Doctor::findOrFail($request->doctor_id);

                /*
            |--------------------------------------------------------------------------
            | SLOT CHECK
            |--------------------------------------------------------------------------
            */

                $slotBooked = Appointment::where('doctor_id', $doctor->id)
                    ->where('appointment_date', $request->appointment_date)
                    ->where('appointment_time', $request->appointment_time)
                    ->exists();

                if ($slotBooked) {

                    DB::rollBack();

                    return back()
                        ->withInput()
                        ->withErrors([
                            'appointment_time' =>
                            'This time slot is already booked.'
                        ]);
                }

                $appointment = Appointment::create([

                    'user_id'           => Auth::id(),
                    'type'              => 'doctor',
                    'doctor_id'         => $doctor->id,
                    'name'              => $request->name,
                    'age'               => $request->age,
                    'phone'             => $request->phone,
                    'gender'            => $request->gender,
                    'email'             => $request->email,
                    'appointment_date'  => $request->appointment_date,
                    'appointment_time'  => $request->appointment_time,
                    'payment_method'    => $request->payment_method,
                    'amount'            => $doctor->consultation_fee,
                    'status'            => $status,

                ]);
            }

            /* ================= SERVICE ================= */ elseif ($request->type === 'service') {

                $service = Service::findOrFail($request->service_id);

                $appointment = Appointment::create([

                    'user_id'           => Auth::id(),
                    'type'              => 'service',
                    'service_id'        => $service->id,
                    'name'              => $request->name,
                    'age'               => $request->age,
                    'phone'             => $request->phone,
                    'gender'            => $request->gender,
                    'email'             => $request->email,
                    'appointment_date'  => $request->appointment_date,
                    'appointment_time'  => $request->appointment_time,
                    'payment_method'    => $request->payment_method,
                    'amount'            => $service->price,
                    'status'            => $status,

                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | ONLINE PAYMENT
        |--------------------------------------------------------------------------
        */

            if ($request->payment_method === 'Online') {

                // IF EMAIL EMPTY => ROLLBACK
                if (!$request->email) {

                    DB::rollBack();

                    return back()
                        ->withInput()
                        ->withErrors([
                            'email' =>
                            'Email is required for online payment.'
                        ]);
                }

                DB::commit();

                return redirect()->route(
                    'payment.page',
                    $appointment->id
                );
            }

            DB::commit();

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

        /* ================= FETCH APPOINTMENT ================= */
        $appointment = Appointment::where('id', $request->appointment_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        /* ================= ALREADY PAID ================= */
        // if ($appointment->status === 'confirmed') {
        //     return back()->with('error', '⚠️ This appointment is already paid.');
        // }

        /* ================= STRICT AMOUNT CHECK ================= */
        if ((float)$request->amount !== (float)$appointment->amount) {
            return back()->with('error', '❌ Please pay the full amount!');
        }

        /* ================= BASIC CARD VALIDATION ================= */
        if (strlen(preg_replace('/\s+/', '', $request->card_number)) < 12) {
            return back()->with('error', '❌ Invalid Card Number');
        }

        /* ================= DETERMINE SOURCE ================= */
        $paymentFor = $appointment->type === 'doctor'
            ? 'Doctor: ' . optional($appointment->doctor)->name
            : 'Service: ' . optional($appointment->service)->name;

        /* ================= CREATE PAYMENT ================= */
        Payment::create([
            'user_id' => auth()->id(),
            'appointment_id' => $appointment->id,
            'payment_method' => 'Card',
            'transaction_id' => 'TXN_' . strtoupper(Str::random(10)),
            'amount' => $appointment->amount,
            'card_number' => substr($request->card_number, -4),
            'expiry' => $request->expiry,
            'cvv' => $request->cvv,
            'status' => 'paid',
        ]);

        /* ================= UPDATE APPOINTMENT ================= */
        $appointment->update([
            'status' => 'confirmed'
        ]);

        /* ================= REDIRECT BASED ON TYPE ================= */
        if ($appointment->type === 'doctor') {
            return redirect()->route('doctor.show', $appointment->doctor_id)
                ->with('success', '✅ Payment successful! Doctor appointment confirmed.');
        } else {
            return redirect()->route('service.show', $appointment->service_id)
                ->with('success', '✅ Payment successful! Service booked successfully.');
        }
    }

    public function payment_page($id)
    {
        $appointment = Appointment::with(['doctor', 'service', 'user'])
            ->where('id', $id)
            ->firstOrFail();

        return view('frontend.payment_page.payment', compact('appointment'));
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
