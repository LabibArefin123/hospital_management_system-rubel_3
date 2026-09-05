<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Newsletter;
use App\Services\AppointmentService;
use App\Services\PaymentService;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FrontendController extends Controller
{
    /* This is for service injection */
    public function __construct(
        protected AppointmentService $appointmentService,
        protected PaymentService $paymentService,
        protected SearchService $searchService
    ) {}

    /* This is for frontend home */
    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('frontend.welcome', compact('doctors'));
    }

    /* This is for doctor listing */
    public function doctor(Request $request)
    {
        $search = trim($request->query('search', ''));
        $doctors = Doctor::query()->when($search, fn($q) => $q->where(
            fn($query) => $query->where('name', 'like', "%{$search}%")
                ->orWhere('speciality', 'like', "%{$search}%")
        ))->latest()->get();

        return view('frontend.doctor_page.doctor', compact('doctors', 'search'));
    }

    /* This is for doctor details */
    public function doctor_show($id)
    {
        $data = $this->appointmentService->doctorDetails($id);
        return view('frontend.doctor_page.doctor_information.show', $data);
    }

    /* This is for service details */
    public function service_show($id)
    {
        $data = $this->appointmentService->serviceDetails($id);
        return view('frontend.service_page.service_information.show', $data);
    }

    /* This is for contact page */
    public function contact()
    {
        return view('frontend.contact_page.contact');
    }

    /* This is for contact store */
    public function contact_store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:contacts,name',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'department' => 'nullable|string',
            'service' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        try {
            Contact::create($data);
            return back()->with('success', 'Message sent successfully!');
        } catch (\Throwable $e) {
            Log::error('Contact submission failed', ['message' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Something went wrong! Please try again.']);
        }
    }

    /* This is for service listing */
    public function service()
    {
        $services = Service::latest()->get();
        return view('frontend.service_page.service', compact('services'));
    }

    /* This is for appointment listing */
    public function appointment()
    {
        [$doctor, $service] = $this->appointmentService->listingQueries(auth()->user());
        return view('frontend.appointment_page.appointment', [
            'doctorAppointments' => $doctor->latest()->get(),
            'serviceAppointments' => $service->latest()->get(),
            'doctors' => Doctor::orderBy('name')->get(),
            'services' => Service::orderBy('title')->get(),
        ]);
    }

    /* This is for doctor appointment filter */
    public function doctor_appointment_filter(Request $request)
    {
        $doctorAppointments = $this->appointmentService
            ->doctorFilter($request, auth()->user())->latest()->get();

        return response()->json([
            'html' => view(
                'frontend.appointment_page.partials.doctor_appointment_cards',
                compact('doctorAppointments')
            )->render(),
            'count' => $doctorAppointments->count(),
        ]);
    }

    /* This is for service appointment filter */
    public function service_appointment_filter(Request $request)
    {
        $serviceAppointments = $this->appointmentService
            ->serviceFilter($request, auth()->user())->latest()->get();

        return response()->json([
            'html' => view(
                'frontend.appointment_page.partials.service_appointment_cards',
                compact('serviceAppointments')
            )->render(),
            'count' => $serviceAppointments->count(),
        ]);
    }

    /* This is for appointment store */
    public function appointment_store(Request $request)
    {
        if ($message = $this->appointmentService->bookingRestriction()) {
            return back()->withInput()->withErrors(['error' => $message]);
        }

        $data = $request->validate([
            'type' => 'required|in:doctor,service',
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:50',
            'gender' => 'required|in:Male,Female',
            'payment_method' => 'required|in:Online,Cash',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'email' => $request->payment_method === 'Online' ? 'required|email' : 'nullable|email',
            'doctor_id' => $request->type === 'doctor' ? 'required|exists:doctors,id' : 'nullable',
            'service_id' => $request->type === 'service' ? 'required|exists:services,id' : 'nullable',
        ], [
            'email.required' => 'Email is required for online payment.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'Invalid payment method selected.',
            'doctor_id.required' => 'Doctor is required.',
            'doctor_id.exists' => 'Selected doctor was not found.',
            'service_id.required' => 'Service is required.',
            'service_id.exists' => 'Selected service was not found.',
        ]);

        try {
            $appointment = $this->appointmentService->create($data);

            /* This is for online payment */
            if ($appointment->payment_method === 'Online') {
                return redirect()->route('payment.page', ['id' => $appointment->id]);
            }

            return $this->appointmentService->cashRedirect($appointment);
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (\Throwable $e) {
            Log::error('Appointment creation failed', ['message' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Unable to create appointment. Please try again.']);
        }
    }

    /* This is for payment store */
    public function payment_store(Request $request)
    {
        $data = $request->validate([
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

        try {
            $payment = $this->paymentService->store($data);
            return $this->paymentService->successRedirect($payment);
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (\Throwable $e) {
            Log::error('Payment submission failed', ['message' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /* This is for payment page */
    public function payment_page($id)
    {
        $appointment = Appointment::with(['doctor', 'service'])
            ->whereKey($id)->where('user_id', auth()->id())->firstOrFail();

        if ($appointment->payment_method !== 'Online') {
            return back()->with('error', 'This appointment does not require online payment.');
        }

        if (Payment::where('appointment_id', $appointment->id)->exists()) {
            return back()->with('error', 'Payment has already been submitted for this appointment.');
        }

        return view('frontend.payment_page.payment', [
            'appointment' => $appointment,
            'transactionId' => $this->paymentService->transactionId(),
        ]);
    }

    /* This is for global search */
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
            return view('frontend.search', ['search' => '']);
        }

        $result = $this->searchService->search($search);
        return $request->ajax()
            ? response()->json($result)
            : view('frontend.search', ['search' => $search]);
    }

    /* This is for newsletter store */
    public function newsletter_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'unique:newsletters,email',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $value)) {
                        $fail('Invalid email format.');
                        return;
                    }
                    $domain = explode('@', $value)[1] ?? null;
                    if (!$domain || strlen($domain) < 5) $fail('Invalid email domain.');
                },
            ],
        ]);

        if ($validator->fails()) {
            Log::warning('Newsletter validation failed', [
                'email' => $request->email,
                'errors' => $validator->errors()->all(),
                'ip' => $request->ip(),
            ]);
            return back()->withErrors($validator)->withInput();
        }

        try {
            $email = $request->email;
            Newsletter::create(['email' => $email, 'domain' => explode('@', $email)[1]]);
            return back()->with('success', 'Subscribed successfully!');
        } catch (\Throwable $e) {
            Log::error('Newsletter subscription error', [
                'message' => $e->getMessage(),
                'email' => $request->email,
            ]);
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
